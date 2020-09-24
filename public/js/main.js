let url = 'http://students.com:8000';
let api = 'http://students.com:8000/api';

//validate form update profile
function validator(formID) {
    let validate = new Validator(document.querySelector(formID), function(err, res){
        // let btn = document.querySelector('.btn-submit');
        // if (res === false) {
        //     confirm.style.borderColor = '#F33';
        //     btn.setAttribute('disabled', '');
        //     return false;
        // } else {
        //     confirm.style.borderColor = '';
        //     btn.removeAttribute('disabled', '');
        //     return true;
        // }
    }, {
        rules: {
            checkImage: function(){
                let value = $(".check-image")[0].files[0];
                return (/\.(gif|jpe?g|tiff|png|webp|bmp)$/i).test(value.name);
            },
            checkPhone: function(value){
                return (/(09|03|08|07)+([0-9]{8})\b/g).test(value);
            }
        },
        messages: {
            en: {
                required: {
                    empty: 'Không được để trống',
                    incorrect: 'Nhập sai thông tin'
                },
                minlength: {
                    empty: 'Hãy nhập tối thiểu {0} ký tự',
                    incorrect: 'Hãy nhập tối thiểu {0} ký tự'
                },
                checkImage: {
                    empty: 'Nhập file ảnh',
                    incorrect: 'File không đúng định dạng'
                },
                checkPhone: {
                    empty: 'Nhập số điện thoại',
                    incorrect: 'Giá trị phải là số điện thoại của Việt Nam'
                }
            }
        }
    });
}

//modal add data
function handelAdd(id) {
    let href = $('#table').data('url');
    let apiRequest = api + href;
    let token = $("[name='_token']").val();
    let value = $("#inputAddName").val();
    let data = {
        _token: token,
        course_id: id,
        name: value
    };
    axios.post(apiRequest, data)
        .then(response => {
            console.log(response);
        })
        .then(() => {
            $('#table-body').append(`
                <tr id="row-{{ $sub->id }}">
                    <td>new</td>
                    <td>` + value + `</td>
                    <td>
                        <a class="btn btn-info disabled">Detail</a>
                        <button class="btn btn-danger disabled">Del</button>
                    </td>
                </tr>
            `);
            Swal.fire({
                position: 'bottom-end',
                icon: 'success',
                title: 'Success !',
                showConfirmButton: false,
                timer: 1500
            })
        })
        .catch(() => {
            Swal.fire({
                position: 'bottom-end',
                icon: 'error',
                title: 'False !',
                showConfirmButton: false,
                timer: 1500
            })
        });
}

//set data modal update
function modalUpdate() {
    $(".btnUpdate").click(function () {
        let id = $(this).data('id');
        let value = $(this).data('value');
        $("#inputUpdateName").val(value);
        $("#update").attr('onclick', 'update(' + id + ')');
    });
}
modalUpdate();


//update data element
function update(id) {
    let href = $("#table").data('url') + '/';
    let api = url + href + id;
    let value = $("#inputUpdateName").val();
    let data = {
        id: id,
        name: value
    };
    console.log(data);
    axios.put(api, data)
        .then((res) => {
            console.log(res);
            $('.name-' + id).text(value);
            Swal.fire({
                position: 'bottom-end',
                icon: 'success',
                title: 'Đã sửa !',
                showConfirmButton: false,
                timer: 1500
            })
        })
        .catch((error) => {
            console.log(error);
            Swal.fire({
                position: 'bottom-end',
                icon: 'error',
                title: 'False ( unique )!',
                showConfirmButton: false,
                timer: 1500
            })
        });
}

//Remove data element
function remove(id) {
    // confirm
    let href = $("#table").data('url') + '/';
    let apiRequest = api + href + id;
    Swal.fire({
        title: 'Chắc chắn xóa ?',
        text: "Sau khi xóa sẽ không lấy lại dữ liệu được!",
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Đồng ý!',
        cancelButtonText: 'Không đồng ý!'
    }).then((result) => {
        if (result.value) {
            // gửi request lên server
            axios.delete(apiRequest)
                .then(() => {
                    var removeElement = document.querySelector('#row-' + id);
                    removeElement.remove();
                    Swal.fire({
                        position: 'bottom-end',
                        icon: 'success',
                        title: 'Đã xóa',
                        showConfirmButton: false,
                        timer: 1500
                    })
                })
                .catch(() => {
                    Swal.fire({
                        position: 'bottom-end',
                        icon: 'error',
                        title: 'False !',
                        showConfirmButton: false,
                        timer: 1500
                    })
                });
        }
    })

}

function confirmPassword() {
    var password = document.querySelector('#password');
    var confirm = document.querySelector('#confirm');
    var btn = document.querySelector('.btn-submit');
    confirm.onkeyup = function () {
        if (confirm.value != password.value) {
            confirm.style.borderColor = '#ff3333';
            btn.setAttribute('disabled', '');
        } else {
            confirm.style.borderColor = '';
            btn.removeAttribute('disabled', '');
        }
    }
}

//action update and create results subject in student
    let stt = $(".results").children().length;
    let course = $("#student").data('course');
    let data = [];
    // lấy danh sách tất cả môn học
    let result = [];
    $.ajax({
        type: "GET",
        url: api + "/subjects/" + course,
        success: function (res) {
            Object.values(res.data).forEach(value => {
                result.push(value);
            })
            $("#create-column").removeAttr('class');
        },
        error: function (err) {
            console.log(err);
        }
    });

    // Thêm column môn học
    $(".create-column").click(function () {
        let option = filterData().map(subject => (`<option value="${subject.id}" >${subject.name}</option>`));
        //render view
        if (data.length != 0)
            $(".results").append(`
                <tr id="row-0${++stt}" class="result-update row-input">
                    <td>${stt}</td>
                    <td>
                        <select class="form-control subjects-${stt}" name="subject[]" onchange="changeSubject('.subjects-${stt}')">
                            `+option+`
                        </select>
                    </td>
                    <td name="result">
                        <input type="text" name="score[]" value="0" class="form-control d-inline-block col-md-8"/>
                        <span class="btn text-danger" onclick="removeColumn(${stt})" ><i class="fas fa-trash-alt"></i></span>
                    </td>
                </tr>
            `)
        else {
            alert('Hết rồi !')
            return false;
        }
        changeSubject()
    });

    function filterData() {
        data = result;
        //lấy danh sách môn đã có
        $("[name='subject[]']").each(function () {
            let subject = $(this).val();
            //lọc ra danh sách môn chưa có
            data = data.filter(obj => obj.id != subject);
        });
        return data;
    }
    function changeSubject() {
        $("select[name='subject[]']").each(function (index, value) {
                let val = $(this).val();
                let name = $(this).children(`[value='${val}']`).text();
                let option = filterData().map(subject =>
                    (`<option value="${subject.id}" >${subject.name}</option>`));
                $(this).html(`<option value="${val}" selected >${name}</option>` + option);
        });
    }

function removeColumn(id) {
    let column = $('#row-0' + id);
    column.remove();
    changeSubject();
}

//action filter
$(document).ready(function () {
    const removeAction = (attr) => (
        $(`${attr}`).remove()
    );
    //filter phonenumber
    $(".filter-phone").on('click', function () {
        let tag = $(this).val();
        var checked = $(this).is(':checked');
        if (checked)
        {
            $(".tags").append(`
                <span class="text-primary tag-${tag}"><i class="fas fa-tag"></i> ${tag}</span>
            `);
        }else
        {
            removeAction(`.tag-${tag}`);
        }
    })
    //filter score
    $(".filter-score").on('blur', function () {
        let min = $("[name='score_min']").val();
        let max = $("[name='score_max']").val();
        if (min || max)
        {
            removeAction(".tag-score");
            $(".tags").append(`
                <span class="text-primary tag-score"><i class="fas fa-tag"></i> Score</span>
            `);
        }

        if (!min && !max)
        {
            removeAction(".tag-score");
        }
    })
    //filter Age
    $(".filter-age").on('blur', function () {

        let min = $("[name='age_min']").val();
        let max = $("[name='age_max']").val();
        if (min || max)
        {
            removeAction(".tag-age");
            $(".tags").append(`
                <span class="text-primary tag-age"><i class="fas fa-tag"></i> Age</span>
            `);
        }

        if (!min && !max)
        {
            removeAction(".tag-age");
        }
    })


})


//handelUpdateProfile ( Cập nhật thông tin sin viên )
$('#formUpdateProfile').on('submit',(function(e) {
    e.preventDefault()
    let student = $("input[name='id']").val();
    let user_id = $("input[name='user_id']").val();
    let data = new FormData($(this)[0]);
    $.ajax({
        type: "POST",
        url: api + "/students/" + student,
        data: data,
        contentType: false,
        processData: false,
        success: function (res) {
           if (res === 'Ok') {
               Swal.fire({
                   position: 'bottom-end',
                   icon: 'success',
                   title: 'Success !',
                   showConfirmButton: false,
                   timer: 1500
               })
               location.reload();
           }
        },
        error: function (err) {
            let error = "";
            Object.values(err.responseJSON.errors).forEach(value => {
                error += value + ' ';
            })
            console.log(error);
            Swal.fire({
                position: 'bottom-end',
                icon: 'error',
                title: 'Error',
                showConfirmButton: false,
                timer: 3000
            })
        }
    })
}));

//handelChangePassword
function changePassword() {
    let data = {
      password: $("input[name='oldPassword']").val(),
      newPassword: $("input[name='newPassword']").val(),
      confirmPassword: $("input[name='confirmPassword']").val()
    };
    axios.put(api+'/account/change-password',data)
        .then((res) => {
            Swal.fire({
                position: 'bottom-end',
                icon: 'success',
                title: 'Success',
                showConfirmButton: false,
                timer: 1500
            })
            // location.reload();
        })
        .catch((error) => {
            console.log(error)
            Swal.fire({
                position: 'bottom-end',
                icon: 'error',
                title: 'Error',
                showConfirmButton: false,
                timer: 1500
            })
        })
}

//update subjects for student
$('tr.create-subject').on('click',function () {
    let parent = $(this).parent().attr('class');
    if (parent === "table-subjects") {
        jQuery(this).detach().appendTo('.table-subject-student')
    } else  if (parent === "table-subject-student") {
        jQuery(this).detach().appendTo('.table-subjects')
    }
})

