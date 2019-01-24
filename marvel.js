var marvel = {
    render: function() {
        var url = "http://gateway.marvel.com/v1/public/characters?limit=4&offset=120&ts=1&apikey=b1c01ec61d10c3b3001cae56b1eb6918&hash=dd770300a6a6f9b398091db2c93507d8";
        var message = document.getElementById("message");
        var footer = document.getElementById("footer");
        var marvelContainer = document.getElementById("marvel-container");
        
        $.ajax ({
            url: url,
            type: "GET",
            beforeSend: function () {
             message.innerHTML = "Loading...";
            },
            complete: function () {
             message.innerHTML = "Success fully done!";
            },
            
            success: function (data) {
             footer.innerHTML = data.attributionHTML;
                var string = "";
                string += "<div class ='card-deck'>";                
                
                for (var i=0; i<data.data.results.length;i++){
                    var element = data.data.results[i];  
                    
                    var html = element.urls[0].url;
                    //alert(html);
                    
                $.ajax({
                data: {"url" : html},
                type: "GET",
                dataType: "json",
                url: "getAttributes.php",
            })
             .done(function( data, textStatus , jqXHR ) {
                 if ( console && console.log ) {
                     console.log( "La solicitud se ha completado correctamente." );
                    
                    var name = data.name;
                    
                    console.log(name+"-"+data.powers);
                     
                    //var attribute = JSON.parse(data);                     
                    //var name = attribute.name;
                    //alert(name);
            
	               //var json_obj = $.parseJSON(data);//parse JSON
                 }
             })
             .fail(function( jqXHR, textStatus, errorThrown ) {
                 if ( console && console.log ) {
                     console.log( "La solicitud a fallado: " +  errorThrown );
                 }
            });
                        
                   
                    
                    //Start Card
                    //string += "<div class ='col-md-3 text-center card'>";
                    string += "<div class ='card'>";
                    string += "  <img class='card-img-top' src ='"+element.thumbnail.path +"/landscape_xlarge."+element.thumbnail.extension+"' />";
                   // string += "  </a>";
                    string += " <div class='card-body'>";
                    string += "   <h5 class='card-title'>" +element.name+ "</h5>";
                   // string += "   <p class='card-text'>" +element.description+ "</p>";
                     string += "   <p class='card-text'>" +element.urls[0].url+ "</p>";
                    string += " </div>"; //Close Card body
                    
                    //string += " <div class='card-footer'>"
                    string += " <div>"
                    string += "   <a href='"+element.urls[0].url+"'target='_blank' class='btn btn-primary btn-lg btn-block'>Saber más</a>";
                    
                    string += " </div>"; //Close Card footer
                    
                    string += "</div>"; //Close Card
                    
                   
                    if((i+1)%4 == 0) {
                        string += "</div>";
                        string += "<div class='card-deck'>";
                    }
                }
                marvelContainer.innerHTML = string;
            },
            
            error: function () {
             message.innerHTML = "We are sorry!";
            }
            
        });
    }
};
marvel.render();