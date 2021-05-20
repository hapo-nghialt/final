$(document).ready(function() {
  function readURL(input, image) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        image.attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#imageProduct").change(function () {
    readURL(this, $('#previewProductImage'));
    $('label[for="imageProduct"] span').addClass('d-none');
  });

  $(document).change(function() {
    for (let i=1;i<=5;i++) {
      imageId = "image_" + i;
      labelImage = "#labelImage" + (i+1);
      labelLastImage = "#labelImage" + i + " " + "span";
      previewImage = "#previewSubImage" + i;
      if (document.getElementById(imageId).files.length !== 0) {
        $(labelImage).removeClass("d-none");
        $(labelLastImage).addClass('d-none');
      }
    }
    if (document.getElementById("image_6").files.length !== 0) {
      $("#labelImage6 span").addClass('d-none');
    }
  })

  $("#image_1").change(function () {
    readURL(this, $('#previewSubImage1'));
  });
  $("#image_2").change(function () {
    readURL(this, $('#previewSubImage2'));
  });
  $("#image_3").change(function () {
    readURL(this, $('#previewSubImage3'));
  });
  $("#image_4").change(function () {
    readURL(this, $('#previewSubImage4'));
  });
  $("#image_5").change(function () {
    readURL(this, $('#previewSubImage5'));
  });
  $("#image_6").change(function () {
    readURL(this, $('#previewSubImage6'));
  });
});
