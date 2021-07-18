
//Create Project Key
function creaetKey(){
    ajax_action();
    function ajax_action(){
        var url = '/data/api/create';
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url : url,
            type : 'POST',
            data : { project_name : document.getElementById('project_key_id').value,
                },
            cache : false,
            dataType : 'json'
        })
        .done(function(data){
            // console.log(data.status);
            if(data.status){
                alert('Success to register project key!');
                window.location.href = "/data/api";
            }else{
                alert('Unexpected Error! Please contact your system administrator.');
            }
            // location.reload();
        })
        .fail(function(XMLHttpRequest, textStatus, errorThrown){
            alert('Please reach out System Administrator');            
        })
    }
}

//Update Project Key
function updateKey(id,action_flg){
    ajax_action(id,action_flg);
    function ajax_action(id,action_flg){
        var url = '/data/api/delete';
        if(action_flg != '1'){
            url = '/data/api/recover';
        }
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url : url,
            type : 'POST',
            data : { key_id : id,
                },
            cache : false,
            dataType : 'json'
        })
        .done(function(data){
            if(data.status){
                alert('Success to update project key!');
                window.location.href = "/data/api";
            }else{
                alert('Unexpected Error! Please contact your system administrator.');
            }
        })
        .fail(function(XMLHttpRequest, textStatus, errorThrown){
            alert('Please reach out System Administrator');            
        })
    }
}