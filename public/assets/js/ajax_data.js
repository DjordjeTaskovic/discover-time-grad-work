
// Function to reset form fields
function resetFormFields() {
    if ($("#Lectures_Form").length) {
        $("#Lectures_Form")[0].reset();
      }
}

$(document).ready(function () {
    // Attach the function to the page load event
    resetFormFields();
    
    //inicial display of lecture in blade
    preformAjaxRequest();

    //sorted displays

    //joined sort events
    function getFormValues() {
        var search = $('#search').val();
        //
        var rating = $('input[type="radio"][name="rating"]:checked').val();
        //
        const checkedcatCheckboxes = $('input[type="checkbox"][name="category"]:checked');
        const checkedcats = checkedcatCheckboxes.map(function () {
                return $(this).val();
                }).get();
        //
        const checkedpriceCheckboxes = $('input[type="checkbox"][name="price"]:checked');
        const checkedprices = checkedpriceCheckboxes.map(function () {
          return $(this).val();
        }).get();
        //
        const pressedskills = $('.option-btn.active').map(function () {
            return $(this).data('value');
        }).get();
        
        const page = $('.pagination-btn.active').attr('value');
        return { 
            search: search,
            rating: rating,
            checkedcats : checkedcats,
            checkedprices : checkedprices,
            pressedskills : pressedskills,
            paginate: true,
            page : page
             };
    }

    function preformAjaxRequest(){
        var formValues = getFormValues();
        
        $.ajax({
                type: 'GET',
                data: formValues,
                 url: "/lectures_ajax",
                success: function(data) {
                lectures_fun(data.items);
                pagination(data);
                },
                error:function (error) {
                console.log(error);
                }
        });
    }
    /////checked search
    $('#search_btn').on('click', function(event) {
            event.preventDefault();
            preformAjaxRequest();
    });
    //
    ////checked rattings
    $('input[type="radio"][name="rating"]').change(function () {
            preformAjaxRequest();
    });
    //checked categories
    $('input[type="checkbox"][name="category"]').change(function () {
            preformAjaxRequest();
    });
    //checked prices
    $('input[type="checkbox"][name="price"]').change(function () {
            preformAjaxRequest();
        
   });
   //skill buttons
    $('.option-btn').click(function (event) {
        event.preventDefault();
        $('.option-btn').removeClass('active');
        $(this).toggleClass('active');
        preformAjaxRequest();

    });
    $(document).on("click", ".pagination-btn", function(e){
        e.preventDefault();
        $(this).toggleClass('active');
        preformAjaxRequest();
    });
  
    //joined sort events - end

      //display functions
      function lectures_fun(data){
        var container = $('#container');
        var html = '';
        data.forEach(ele => {
            var star_result =``;
            if(ele.average_review != 0){
                star_result+=` <li style="color:gold;font-size:15px;">${ele.average_review} </li>`;
                for (let index = 1; index <= ele.average_review; index++) {
                  star_result += `<li class="active" style="color:gold;"><i class="fa fa-star"></i></li> `
                    
                    };
                for (let index = 1; index <= 5 - ele.average_review; index++) {
                    star_result += `<li><i class="fa fa-star"></i></li>`
                };
            }
            
            html += `<div class="blog-post blog-md clearfix">
            <div class="ttr-post-media"> 
                <a href="#"><img src="assets/images/historical_data/${ele.cover_image}" alt="cover_image"></a> 
            </div>
            <div class="ttr-post-info">
                <ul class="media-post">
                    <li><a href="#"><i class="fa fa-calendar"></i>${ele.created_at}</a></li>
                    <li><a href="#"><i class="fa fa-file"></i>${ele.difficulty} - ${ele.price}$</a></li>
                    <li><a href="#"><i class="fa fa-book"></i>${ele.skill_name}</a></li>
                    <li>
                        <ul class="cours-star">
                          ${star_result}
                        </ul>
                    </li>
                </ul>
                <h5 class="post-title"><a href="/public/lecture_details/${ele.LectureID}">${ele.lecture_name}</a></h5>
                <p>Knowing that, you've optimised your pages countless amount of times, written tons.</p>
                <div class="post-extra">
                    <a href="/public/lecture_details/${ele.LectureID}" class="btn-link">READ MORE</a>
                    <a href="/public/lecture_details/${ele.LectureID}" class="comments-bx">
                    <i class="fa fa-comments-o"></i>(${ele.comment_count}) Comments</a>
                </div>
            </div>
        </div>`;
            
        });
        container.html(html);
      };

    //display pagination
    function pagination(data){
        var container = $('#pagination');
        var html = '';
        html +=`
        <ul class="pagination">
            <li class="previous">
                <a href="#" class="pagination-btn" value="${data.page > 1 ? data.page - 1 : data.page}">
                     <i class="ti-arrow-left"></i> Prev
                </a>
            </li>`;

            for (let index = 1; index <= data.pagesCount; index++) {
                html += `
                    <li>
                        <a href="#" class="pagination-btn" value="${index}" > ${index}</a>
                    </li>
                `;
            }
        html +=`
            <li class="next">
                <a href="#" class="pagination-btn" value="${data.page < data.pagesCount ? data.page + 1 : data.page}">
                    Next <i class="ti-arrow-right"></i>
                </a>
            </li>
        </ul> `;
        container.html(html);
      };

     
    
});// <--- ready function end

