var marvel = {
    render: function() {
        var url = "http://gateway.marvel.com/v1/public/characters?limit=07&offset=10&ts=1&apikey=b1c01ec61d10c3b3001cae56b1eb6918&hash=dd770300a6a6f9b398091db2c93507d8";
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
            
            string += "<div class='carousel-inner row w-100 mx-auto'>";
                
                
        for (var i=0; i<data.data.results.length;i++){
            var element = data.data.results[i];  
            var imagen = element.thumbnail.path+"/landscape_xlarge."+element.thumbnail.extension; 
            var nombre = element.id; 
            var id = element.name; 
            var descripcion = element.description ;
            var url_c = element.urls. ; 
           
            
            console.log(i+'-'+ nombre+'-'+imagen+'-'+url_c);
                    
            string += "<div class='carousel-item col-md-4 active'>";
            //Start Card
             string += "<div id ='card1' class ='card'>";
              
               string += "<div class ='front'>";
               string += "  <img class='card-img-top' src ='"+element.thumbnail.path +"/landscape_xlarge."+element.thumbnail.extension+"'>";                   
               string += "   <div class='card-body'>";
               string += "    <h5 class='card-title'>" +element.name+ "</h5>"; 
               string += "    <p class='card-text'>" +element.description+ "</p>";
               string += "   </div>"; //Close Card body
               string += " </div>"; //Close Front
               
               string += "<div class ='back'>";
               string += " <div class='card-body'>";
               string += "  <p class='card-text'>This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>";
               string += " </div>"; //Close Card body    
              string += " <div class='card-footer'>"
              //string += " <div>"
              string += "   <a href='"+element.urls[0].url+"'target='_blank' class='btn btn-primary btn-lg btn-block'>Saber más</a>";
              string += " </div>"; //Close Card footer
              string += "</div>"; //Close Back        
            
            
              string += "</div>"; //Close Card - Final carta 
              string += "</div>"; //Close carousel-item
                }
                string += "</div>"; //Close carousel-inner
                
                //Buttons slider
                string += "<a class='carousel-control-prev' href='#marvel-container' role='button' data-slide='prev'>";
                string += "<span class='carousel-control-prev-icon' aria-hidden='true'></span>";
                string += "<span class='sr-only'>Previous</span>";
                string += "</a>";
                string += "<a class='carousel-control-next' href='#marvel-container' role='button' data-slide='next'>";
                string += "<span class='carousel-control-next-icon' aria-hidden='true'></span>";
                string += "<span class='sr-only'>Next</span>";
                string += "</a>";
                
                /*string += "<script src='https://cdn.rawgit.com/nnattawat/flip/master/dist/jquery.flip.min.js'>
                string += "</script>";
                string += "<script>";                                
                string += "$('.card').flip()";  
                string += "</script>";*/
                
                marvelContainer.innerHTML = string;
            },
            
            error: function () {
             message.innerHTML = "We are sorry!";
            }
            
        });
    }
};
marvel.render();