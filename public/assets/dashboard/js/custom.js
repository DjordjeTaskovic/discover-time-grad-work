window.onload = function(){

    //Trigering sub forms on checkbox event 
     $(".insertcat").on('click', function() {
        var $box = $(this);
        if ($box.is(":checked")) {
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            $(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
    });
    // Inserting file inputs into html **************
    $( "#image_addition" ).on( "click", function() {
        var html = `<input type="file" name="filename[]" class="form-control" id="input">`;
        $( "#increment" ).append( html );
    });

   
    // modal star selection settings
    $("#send").on('click',function () {
        const selectedRating = document.querySelector('input[name="rate"]:checked').value;
        console.log("Selected rating:", selectedRating);
    })
     const starLabels = document.querySelectorAll(".star-update label");
        starLabels.forEach((label) => {
            label.addEventListener("click", () => {
                const radio = label.previousElementSibling;
                radio.checked = true;
                });
        });

    /// notifications settings
    if ($(".noti-close").length) {
        $('.noti-close').on('click', function(event) {
            // Trigger the form submission programmatically
            event.preventDefault(); 
            formElement = $(this).closest('form');
            formElement.submit();
          });
    }

    
}

