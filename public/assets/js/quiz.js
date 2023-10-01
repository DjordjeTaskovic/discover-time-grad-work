$(document).ready(function () {
    //variables
    if($(".quiz-line").length){

    const previousButton = document.getElementById("previous");
    const nextButton = document.getElementById("next");
    const submitButton = $('#submit_quiz');
    let currentSlide = 0;
    var firstQuizLineElement = document.querySelectorAll('.quiz-line');
 
   // Show the first slide
   showSlide(currentSlide);

      function writeAnswersAndButtons(data){
        var container = $('.curriculum-list-results');
        var buttons = $('.quiz-buttons-wrapper');
        var html = '';
        html +=`
          <li class="result-line">
          <div class="quiz-results">
              <p>Your total score is: ( ${data.totalScore} ) </p>
              <p>You have succesfully compleated: ( ${data.currentPercentage}% )  of the questions.</p>
              <p>By compleation of this quiz, you have been added to a scoreboard!</p>
            </div>
        </li>`;
        var btn = '';
        btn +=`
            <a class="ud-btn ud-btn-primary quiz-btn" href="/quiz_details/${data.lecture_ID}">Repeat the quiz</a>
            <a class="ud-btn ud-btn-primary quiz-btn" href="#">To the scoreboard</a>
              `;
        container.html(html);
        buttons.html(btn);
       
        $('.result-line').addClass('active-result-line');
    }

    function preformAjaxRequest(data){
      // console.log(data);
        $.ajax({
            type: 'GET',
            data: data,
            url: "/ajax_quiz",
            success: function(data) {
                //console.log(data);
                writeAnswersAndButtons(data);
            },
            error:function (error) {
            console.log(error);
            }
        });
    }
   // // Event listeners
   
    submitButton.on('click', function(event) {
        event.preventDefault();

        const checkedAnsweresRadios = $('input[type="radio"][class="answer"]:checked');
        const checkedanswers = checkedAnsweresRadios.map(function () {
                return $(this).val();
                }).get();
        const LectureID = $('input[type="hidden"]').val();

        $('.quiz-line').removeClass('active-quiz-line');
      //$('.quiz-btn').css('display','none');
        preformAjaxRequest({LectureID,checkedanswers});
         
    });
    
   previousButton.addEventListener("click", showPreviousSlide);
   nextButton.addEventListener("click", showNextSlide);

    function showSlide(n) {

        firstQuizLineElement[currentSlide].classList.remove('active-quiz-line');
        firstQuizLineElement[n].classList.add('active-quiz-line');
        currentSlide = n;
        if(currentSlide === 0){
          previousButton.style.display = 'none';
        }
        else{
          previousButton.style.display = 'inline-block';
        }
        if(currentSlide === firstQuizLineElement.length - 1){
          nextButton.style.display = 'none';
          submitButton.css('display','inline-block');
        }
        else{
          nextButton.style.display = 'inline-block';
          submitButton.css('display','none');
        }
      }
    //event functions
    function showNextSlide() {
        showSlide(currentSlide + 1);
    }
    
    function showPreviousSlide() {
        showSlide(currentSlide - 1);
    }
   
  }
});