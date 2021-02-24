$(document).ready(function() { 
    $("#checkConfirmed").on('change',statusCheck);
    function statusCheck(){
        if($('#checkConfirmed').val()=='Confirmed'){
            $("#ifConfirmed").css("display", "block");        
        }else{
            $("#ifConfirmed").css("display", "none");        
        }
    }

    $(function(){
        $('#event-edit-submit-button').on('click', function(){
          $('#event-edit-form').submit();
        });
      })

    
// Toggle Search Bar

$("#search-toggle").on("click",displaySearchBar);

function displaySearchBar(){
    if ($("#searchBar").css("display")=="block") {
        $("#searchBar").css("display", "none");    
    }
    else{
        $("#searchBar").css("display", "block");    
    }
}

    // $('#access_id_0').is(':checked',function(){
    //     $('#access_id_0').prop("checked",true);
    //     $('#access_id_0').prop("value","aa");
    // });
     
    // $('#access_id_1').is(':checked',function(){
    //     $('#access_id_1').prop("checked",true);
    //     $('#access_id_1').prop("value","ra");
    // });
}); 

