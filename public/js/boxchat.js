var origin   = window.location.origin;
var student = document.currentScript.getAttribute('student');
$(document).ready(function(){
    console.log(origin)
    $('#action_menu_btn').click(function(){
        $('.action_menu').toggle();
    });

    $('#formChat').submit(function (e) {
        e.preventDefault();
        let message = $(`textarea[name='message']`);
        let formData = new FormData($(this)[0]);
        $.ajax({
            url: origin + '/chat/pusher',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (res) {
                $('.detail-message').append(`
                    <div class="d-flex justify-content-end mb-4">
                        <div class="msg_cotainer_send">
                            `+message.val()+`
                            <span class="msg_time_send">${new Date().getHours()}:${new Date().getMinutes()}</span>
                        </div>
                        <div class="img_cont_msg">
                            <img src="${origin}/images/avatars/${res.avatar}" class="rounded-circle user_img_msg">
                        </div>
                    </div>
                `);
                message.val('');
                $('.detail-message').animate({
                    scrollTop: $(this).get(0).scrollHeight
                }, 1000);
            },
            error: function (errors) {
                console.log(errors)
            }
        })
    })

});

$(document).ready(function () {
    let messageWrapper   = $('.message-wrapper');
    let messages         = messageWrapper.find('ul.messages');
    let message          = messageWrapper.find('.detail-message');
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = false;

    let pusher = new Pusher('905c5af763ecadd5bca2', {
        cluster: 'ap1',
        encrypted: true
    });

    // Subscribe to the channel we specified in our Laravel Event
    let channel = pusher.subscribe('Chat');

    // Bind a function to a Event (the full Laravel class)
    channel.bind('send-message', function(data) {
        let existingMessage = message.html();
        let newMessageHtml = `
                  <div class="d-flex justify-content-start mb-4">
                        <div class="img_cont_msg">
                            <img src="`+origin+'/images/avatars/'+data.avatar+`" class="rounded-circle user_img_msg">
                        </div>
                        <div class="msg_cotainer">
                            `+data.message+`
                            <span class="msg_time">`+data.timeline+`</span>
                        </div>
                  </div>
            `;
        if(student == data.id) {
            message.html(existingMessage + newMessageHtml);
            $('.detail-message').animate({
                scrollTop: $(this).get(0).scrollHeight
            }, 1000);
        }
    });
});
