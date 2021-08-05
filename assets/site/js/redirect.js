$(document).ready(function()
{
    var redirect_url = $('#redirect').attr("data-redirect");
    
    function redirect()
    {
        window.open(redirect_url, '_blank');
        $.ajax({
            url: '/sessiondestroy',
            Type:'GET',
            dataType:'json',
            success:function(data)
            {
                if(data.destroi == true)
                {
                    window.location.reload();
                }
            }
        })
    }

    redirect();

});