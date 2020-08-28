import 'owl.carousel';

export default class Utils {
    contructor() {
        this.init();
    }

    init() {
        this.mainSlider();
    }
    mainSlider() {

        $(document).ready(functionr())
        {
        
            $('.owl-carousel').owlCarousel();

        };
        var links = document.querySelectorAll('.slider a');
        var slides = document.querySelectorAll('section');

        var slidesToHide = [...slides];
        slidesToHide.pop();

        slidesToHide.forEach(slide=>slide.classList.add('hidden'));

        links.forEach(link => link.addEventListener ('click', function(e){
            e.preventDefault();

            slides.forEach(slide => slide.classList.add('hidden'));

            var elementId = this.attributes[0].value;
            elementId = elementId.slice(1);

            var selectedSlide = document.getElementById(elementId);

            selectedSlide.classList.remove('hidden');
        }));

    }
}


// var userbox = document.getElementsByClassName('row');
//fetch ('https://api.github.com/repos/womenintechnology/bootcamp-team-t/contributors')
    //.then(response => response.json())
    //.then(data => {


    //var row = document.getElementbyId('github-users');

    //data.forEach(element => {
        //var userDiv = null;
       // if(element.type == "User"){
            //console.log(element.avatar_url);
           // userDiv = document.createElement ("div");

            //userDiv.innerHTML = "<p>" + element.login + "</p>";

            //console.log(row);

            //row.insertBefore(userDiv,null);
       // }
  //  })



