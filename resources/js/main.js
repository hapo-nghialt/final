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

  // function previewSubImage(i) {
  //   readURL(this, $("#previewImage" + i +""));
  //   $('label[for="image_" ' + i +']').addClass('d-none');
  // }
});
