
//Create Login Information
function createLogin(){
    ajax_action();
    function ajax_action(){
        var url = '/data/login/create';
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url : url,
            type : 'POST',
            data : { user_name : document.getElementById('inputUser').value,
                    password : document.getElementById('inputPassword').value
                },
            cache : false,
            dataType : 'json'
        })
        .done(function(data){
            console.log(data.status);
            alert('Success to register login information!');
            // location.reload();
            window.location.href = "/data/login";
        })
        .fail(function(XMLHttpRequest, textStatus, errorThrown){
            alert('Please reach out System Administrator');            
        })
    }
}