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
    $('label[for="imageProduct"]').addClass('d-none');
  });

  $(document).change(function() {
    for (let i=1;i<=5;i++) {
      imageId = "image_" + i;
      labelImage = "#labelImage" + (i+1);
      labelLastImage = "#labelImage" + i;
      previewImage = "#previewSubImage" + i;
      if (document.getElementById(imageId).files.length !== 0) {
        $(labelImage).removeClass("d-none");
        $(labelLastImage).addClass('d-none');
      }
    }
  })

  $("#image_1").change(function () {
    readURL(this, $('#previewSubImage1'));
    $('label[for="image_1"]').addClass('d-none');
  });
  $("#image_2").change(function () {
    readURL(this, $('#previewSubImage2'));
    $('label[for="image_2"]').addClass('d-none');
  });
  $("#image_3").change(function () {
    readURL(this, $('#previewSubImage3'));
    $('label[for="image_3"]').addClass('d-none');
  });
  $("#image_4").change(function () {
    readURL(this, $('#previewSubImage4'));
    $('label[for="image_4"]').addClass('d-none');
  });
  $("#image_5").change(function () {
    readURL(this, $('#previewSubImage5'));
    $('label[for="image_5"]').addClass('d-none');
  });
  $("#image_6").change(function () {
    readURL(this, $('#previewSubImage6'));
    $('label[for="image_6"]').addClass('d-none');
  });
});

