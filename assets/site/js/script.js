$(document).ready(function()
{
    var width = getWidthScreen();


    function getWidthScreen()
    {
        return $(window).width();
    }

    if(width > 900)
    {
        $('.setcontainer').removeClass('container-sm');
        $('.setcontainer').addClass('container-xl');
    }else
    {
        $('.setcontainer').removeClass('container-xl');
        $('.setcontainer').addClass('container-sm');
    }


    $('#estado').on('change', function()
	{
		var estado = $(this).val();
		
		$.ajax({  
			type: "POST",  
			url: "/getCidade",  
			data: {estado: estado},
			success: function(data)
			{
				var obj = JSON.parse(data);
				
				$('#cidadeEscolha').html('<option value="">Cidade</option>');
				
				for(var i = 0; i < obj.length; i++)
				{
					$('#cidadeEscolha').append('<option value="'+obj[i].cidade+'">'+obj[i].cidade+'</option>')
				}
				
			}  
		});
	});

    $('#cidadeEscolha').on('change', function()
	{
		var cidade = $(this).val();
		
		$.ajax({  
			type: "POST",  
			url: "/getBairros",  
			data: {cidade: cidade},
			success: function(data)
			{
				var obj = JSON.parse(data)
				
				$('#bairrosEscolha').html('<option value="">Bairro</option>');
				
				for(var i = 0; i < obj.length; i++)
				{
					$("#bairrosEscolha").append('<option value="'+obj[i].bairro+'">'+obj[i].bairro+'</option>');
				}
				
			}  
		});
		
	});


    $('.favorites-add-remove').on('click', function()
    {
        var url = $(this).attr('data-url');
        var data_favorites = $(this).attr('data-favorites');

        var obj_favorites = $(this);
        
        if(data_favorites == "add")
        {
            $.ajax({
                type: "POST",
                url: '/addFavorites',
                data: {url: url},
                dataType: 'json',
                success: function(data)
                {
                    obj_favorites.attr('data-favorites', 'remove');
                    obj_favorites.html('<i class="fas fa-heart favorites"></i>');

                    if(data.count > 0)
                    {
                        $('.link-favorites').html('Favoritos <span class="badge badge-primary">'+data.count+'</span>');
                    }else
                    {
                        $('.link-favorites').html('Favoritos');
                    }
                }
            });
        }else
        {
            $.ajax({
                type: 'POST',
                url: '/removeFavorites',
                data: {url: url},
                dataType: 'json',
                success: function(data)
                {
                    obj_favorites.attr('data-favorites', 'add');
                    obj_favorites.html('<i class="far fa-heart favorites"></i>');
                    
                    if(window.location.pathname == "/imoveisfavorites")
                    {
                        window.location.reload();
                    }

                    if(data.count > 0)
                    {
                        $('.link-favorites').html('Favoritos <span class="badge badge-primary">'+data.count+'</span>');
                    }else
                    {
                        $('.link-favorites').html('Favoritos');
                    }
                }
            })
        }
    });
    
    $('.favorites').on('mousemove', function()
    {
        $(this).removeClass('far');
        $(this).addClass('fas');
    });

    $('.favorites').on('mouseout', function()
    {
        $(this).removeClass('fas');
        $(this).addClass('far');
    });

	$('.removefavorites').on('mousemove', function()
    {
        $(this).removeClass('fas');
        $(this).addClass('far');
    });

    $('.removefavorites').on('mouseout', function()
    {
        $(this).removeClass('far');
        $(this).addClass('fas');
    });


    $('.cards-content').on('click', function()
    {
        var path_url = $(this).attr('data-url');

        var url = "/imovel/"+path_url+"";

        window.location.href = url;
    });


    $('#whatsapp').on('click', function()
    {
        window.open('https://api.whatsapp.com/send?phone=5535988191124&text=Oi%2C%20te%20achei%20pelo%20site.', '_blank')
    });


    $('#openLocation').on('click', function()
    {
        var os = OSName();

        if(os == 'Windows' || os == 'Mac OS' || os == 'Linux')
        {
            window.location = "/contato#mapa";
        }else if(os == 'Android')
        {
            window.location = "https://maps.google.com/maps?daddr=R. Dep. Lourenço de Andrade, 687 - Centro, Passos - MG, 37900-093";
        }else if(os == 'iOS')
        {
			window.location = "https://maps.apple.com/?daddr=R. Dep. Lourenço de Andrade, 687 - Centro, Passos - MG, 37900-093";
        }
    });


    function OSName()
    {
        var userAgent = window.navigator.userAgent,
        platform = window.navigator.platform,
        macosPlatforms = ['Macintosh', 'MacIntel', 'MacPPC', 'Mac68K'],
        windowsPlatforms = ['Win32', 'Win64', 'Windows', 'WinCE'],
        iosPlatforms = ['iPhone', 'iPad', 'iPod'],
        os = null;
    
        if(macosPlatforms.indexOf(platform) !== -1)
        {
            os = 'Mac OS';
        }else if (iosPlatforms.indexOf(platform) !== -1)
        {
            os = 'iOS';
        }else if (windowsPlatforms.indexOf(platform) !== -1)
        {
            os = 'Windows';
        }else if(/Android/.test(userAgent))
        {
            os = 'Android';
        }else if (!os && /Linux/.test(platform))
        {
            os = 'Linux';
        }
    
        return os;

    
    }

});