

function remove(removeId){
    // confirm
    let api = 'http://localhost/php3/public/dv-admin/product-delete/';
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
            var deleteUrl = api + removeId;
            axios.delete(deleteUrl)
                .then(response => {
                    console.log(response);
                })
                .then(() => {
                    var removeElement = document.querySelector('#row-' + removeId);
                    removeElement.remove();
                    Swal.fire({
                        position: 'bottom-end',
                        icon: 'success',
                        title: 'Đã xóa',
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
    var btn     = document.querySelector('.btnRegister');
    confirm.onkeyup = function () {
        if (confirm.value != password.value){
            confirm.style.borderColor = '#F33';
            btn.setAttribute('disabled','');
        }else {
            confirm.style.borderColor = '';
            btn.removeAttribute('disabled','');
        }
    }
}
function remove(removeId){
    // confirm
    let api = 'http://localhost/php3/public/dv-admin/product-deleteDetail/';
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
            var deleteUrl = api + removeId;
            axios.delete(deleteUrl)
                .then(response => {
                    console.log(response);
                })
                .then(() => {
                    var removeElement = document.querySelector('#row-' + removeId);
                    removeElement.remove();
                    Swal.fire({
                        position: 'bottom-end',
                        icon: 'success',
                        title: 'Đã xóa',
                        showConfirmButton: false,
                        timer: 1500
                    })
                });
        }
    })

}
