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
      if (($('#' + imageId).length !== 0) && (document.getElementById(imageId).files.length !== 0)) {
        $(labelImage).removeClass("d-none");
        $(labelLastImage).addClass('d-none');
      }
    }
    if (($('#image_6').length !== 0) && (document.getElementById("image_6").files.length !== 0)) {
      $("#labelImage6 span").addClass('d-none');
    }
  });
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
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $('#cartBtn').click(function() {
    let productId = $('#productId').val();
    let customerId = $('#customerId').val();
    let quantity = $('#productQuantity').val();
    let unitPrice = $('#unitPrice').val();
    let numberOrder = Number($('#numberOrder').val());
    let imageSuccess = $('#imageSuccess').val();
    let url = $('#urlAddToCart').val();
    let amount = quantity * unitPrice;
    let urlCart = $('#urlCart').val();
    $.ajax({
      url: url,
      type: "POST",
      data: {
        productId: productId,
        customerId: customerId,
        quantity: quantity,
        amount: amount,
      },
      success: function (result) {
        let orderId = [];
        $("input[name='orderId[]']").each(function () {
          orderId.push($(this).val());
        })
        if (numberOrder == 0) {
          $("#linkCart").append(
              "<span class='index' id='numberOrderToCart'>1</span>"
          );
        }
        numberOrder += 1;
        $("#numberOrder").val(numberOrder);
        $(".message-success").append(
            "<div>" +
            "<img alt='' src=" + imageSuccess + ">" +
            result.message +
            "</div>"
        );
        $("#cartEmpty").remove();
        if (orderId.includes(productId) == false) {
          $("#numberOrderToCart").html(numberOrder);
          document.getElementById('urlCart').setAttribute("href", urlCart);
          if (numberOrder == 1) {
            $("#listItem").append(
                "<div class=\"new-item-text\">Sản phẩm mới thêm</div>" +
                "<a href='" + result.productUrl + "'>" +
                "<div class='cart-item'>\n" +
                "<input type='hidden' name='orderId[]' value=" + productId + ">" +
                "<div class='cart-item-image'>\n" +
                "<img src='" +
                result.productImage +
                "' alt=''>\n" +
                "</div>\n" +
                "<div class='cart-item-information'>\n" +
                "<div class='cart-item-name'>\n" +
                result.productName +
                "</div>\n" +
                "<div class='cart-item-price'>\n" +
                "₫" + result.productPrice +
                "</div>\n" +
                "</div>\n" +
                "</div>" +
                "</a>" +
                "<a class=\"see-cart-button\" id='seeCartButton' href='" + urlCart + "'>Xem giỏ hàng</a>"
            );
          } else {
            $("#seeCartButton").remove();
            $("#listItem").append(
                "<a href='" + result.productUrl + "'>" +
                "<div class='cart-item'>\n" +
                "<input type='hidden' name='orderId[]' value=" + productId + ">" +
                "<div class='cart-item-image'>\n" +
                "<img src='" +
                result.productImage +
                "' alt=''>\n" +
                "</div>\n" +
                "<div class='cart-item-information'>\n" +
                "<div class='cart-item-name'>\n" +
                result.productName +
                "</div>\n" +
                "<div class='cart-item-price'>\n" +
                "₫" + result.productPrice +
                "</div>\n" +
                "</div>\n" +
                "</div>" +
                "</a>" +
                "<a class=\"see-cart-button\" id='seeCartButton' href='" + urlCart + "'>Xem giỏ hàng</a>"
            );
          }
        }
        setTimeout(function () {
          $(".message-success div").remove();
        }, 1000);
      }
    });
  });
  function disabledInput(orderId) {
    $('.btn-reduce[data-id="' + orderId + '"]').addClass('disabled-input');
    $('.btn-increase[data-id="' + orderId + '"]').addClass('disabled-input');
    $('#productQuantity' + orderId).addClass('disabled-input');
    setTimeout(function () {
      $('.btn-reduce[data-id="' + orderId + '"]').removeClass('disabled-input');
      $('.btn-increase[data-id="' + orderId + '"]').removeClass('disabled-input');
      $('#productQuantity' + orderId).removeClass('disabled-input');
    }, 500);
  }
  $('.btn-reduce').click(function() {
    if ($(this).data('id')) {
      let orderId = $(this).data('id');
      let unitPrice = $('#unitPrice' + orderId).val();
      let productQuantity = Number($('#productQuantity' + orderId).val()) - 1;
      if (productQuantity <= 0) {
        productQuantity = 1;
      }
      $('#productQuantity' + orderId).val(productQuantity);
      let totalPrice = Intl.NumberFormat('ja-JP').format(productQuantity * unitPrice);
      document.getElementById('totalPrice' + orderId).innerHTML = '₫' + totalPrice;
      disabledInput(orderId);
    } else {
      let productQuantity = Number($('#productQuantity').val()) - 1;
      if (productQuantity <= 0) {
        productQuantity = 1;
      }
      $('#productQuantity').val(productQuantity);
    }
  })
  $('.btn-increase').click(function() {
    if ($(this).data('id')) {
      let orderId = $(this).data('id');
      let unitPrice = $('#unitPrice' + orderId).val();
      let productQuantity = Number($('#productQuantity' + orderId).val()) + 1;
      if (productQuantity <= 0) {
        productQuantity = 1;
      }
      $('#productQuantity' + orderId).val(productQuantity);
      let totalPrice = Intl.NumberFormat('ja-JP').format(productQuantity * unitPrice);
      document.getElementById('totalPrice' + orderId).innerHTML = '₫' + totalPrice;
      disabledInput(orderId);
    } else {
      let productQuantity = Number($('#productQuantity').val()) + 1;
      if (productQuantity <= 0) {
        productQuantity = 1;
      }
      $('#productQuantity').val(productQuantity);
    }
  })
  $('input[name="product-quantity"]').keyup(function() {
    if ($(this).data('id')) {
      let orderId = $(this).data('id');
      let unitPrice = $('#unitPrice' + orderId).val();
      let productQuantity = Number($('#productQuantity' + orderId).val());
      if (!productQuantity) {
        productQuantity = 1;
      } else {
        disabledInput(orderId);
      }
      let totalPrice = Intl.NumberFormat('ja-JP').format(productQuantity * unitPrice);
      document.getElementById('totalPrice' + orderId).innerHTML = '₫' + totalPrice;
    }
  })
  $('input[name="product-quantity"]').focusout(function() {
    if ($(this).data('id')) {
      let orderId = $(this).data('id');
      let productQuantity = Number($('#productQuantity' + orderId).val());
      if (productQuantity == 0) {
        productQuantity = 1;
        disabledInput(orderId);
        $('#productQuantity' + orderId).val(productQuantity);
      }
    } else {
      let productQuantity = Number($('#productQuantity').val());
      if (productQuantity == 0) {
        productQuantity = 1;
        $('#productQuantity').val(productQuantity);
      }
    }
  });
  $('#avatar').change(function() {
    readURL(this, $('#previewUserAvatar'));
    $('#user-avatar').remove();
    $('#previewUserAvatar').removeClass('d-none');
  });
  $('#image').change(function() {
    readURL(this, $('#previewCategoryImage'));
    $('#previewCategoryImage').removeClass('d-none');
  });
  setTimeout(function() {
    $('#messageSuccess').remove();
  }, 2000)
  $('#buttonFollow').click(function() {
    $('#buttonUnfollow').removeClass('d-none');
    $('#buttonFollow').addClass('d-none');
    url = $('#followUrl').val();
    followerId = $('#followerId').val();
    followingId = $('#followingId').val();
    followerNumber = Number($('#followerNumber').html())
    document.getElementById('followerNumber').innerHTML = followerNumber + 1;
    $.ajax({
      url: url,
      type: "POST",
      data: {
        followerId: followerId,
        followingId: followingId,
      },
      success: function (result) {
      }
    });
  });
  $('#buttonUnfollow').click(function () {
    $('#buttonUnfollow').addClass('d-none');
    $('#buttonFollow').removeClass('d-none');
    url = $('#unfollowUrl').val();
    followerId = $('#followerId').val();
    followingId = $('#followingId').val();
    followerNumber = Number($('#followerNumber').html())
    document.getElementById('followerNumber').innerHTML = followerNumber - 1;
    $.ajax({
      url: url,
      type: "DELETE",
      data: {
        followerId: followerId,
        followingId: followingId,
      },
      success: function (result) {

      }
    });
  });
  $('#buttonChat').click(function() {
    $(this).addClass('d-none');
    $('.chat-content').css({'visibility': 'visible', 'opacity': '1'});
  })
})
$('.follow-product').click(function() {
  url = $('#urlFollowProduct').val();
  productId = $(this).data('id');
  userId = $('#userId').val();
  $.ajax({
    url: url,
    type: "POST",
    data: {
      userId: userId,
      productId: productId
    },
    success: function (result) {

    }
  })
  if ($(this).hasClass('followed')) {
    $(this).removeClass('followed');
  } else {
    $(this).addClass('followed');
  }
})
