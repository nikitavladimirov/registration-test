var errorMessages = {
    checkEmail: 'Неверный формат email',
    userExists: 'Пользователь с таким email уже существует',
    passwordCompare: 'Пароли не совпадают'
}

function addErrorMessage(message) {
    if($('#registration .message-error').length) {
        $('#registration .message-error').remove()
    }
    $('#registration').prepend(
        '<div class="message-error text-center p-2">' + message +'</div>'
    )
}


$(function() {
    $('#registration').submit(function (e) {
        e.preventDefault()
        let form = document.getElementById('registration');
        let formData = new FormData(form)
        $.ajax({
            type: 'post',
            url: 'registration.php',
            processData: false,
            contentType : false,
            data: formData,
            success: function(response) {
                console.log(response)
                let json = JSON.parse(response)
                console.log(json)
                if (!json.checkEmail) {
                    addErrorMessage(errorMessages.checkEmail)
                }
                else if (json.resultUser) {
                    addErrorMessage(errorMessages.userExists)
                } 
                else if (json.resultPassword != 0) {
                    addErrorMessage(errorMessages.passwordCompare)
                } else {
                    $('.registration-card').hide()
                    $('.success-card').show()
                }
            }
        })
    })
})
