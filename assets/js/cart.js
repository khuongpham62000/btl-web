function toFixed(x) {
  return Number.parseFloat(x).toFixed(2);
}

var cartRow = (product, quantity) => {
  return `
<tr item-id="${product.id}" onclick="preview(event)">
  <td>${product.name}</td>
  <td>${product.price}</td>
  <td>${quantity}</td>
  <td>${toFixed(product.price * quantity)}</td>
</tr>
    `;
};

var roller = () => {
  return `
  <div class="centered" style="width: fit-content;">
  <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
  </div>
  `;
};

var updateStatus = (status) => {
  return `<div class="centered">
    <div style="text-align:center">${status}</div>
    <div class="total_row">
      <button id="close-modal" class="confirm-button">Ok</button>
    </div>
  </div>`;
};

var inputForm = () => {
  return user_id === -1
    ? `
  <div class="centered">
    <div class="item_input col">
        <div style="padding-bottom: 1rem;text-align:center">Please add Your Name below:</div>
        <input class="item_input" type="text" name="name" id="name" autocomplete="off">
    </div>
    <div class="item_input col">
        <div style="padding-bottom: 1rem;text-align:center">Please add Phone number below:</div>
        <input class="item_input" type="number" name="phone" id="phone">
    </div>
    <div class="item_input col">
        <div style="padding-bottom: 1rem;text-align:center">Please add Address below:</div>
        <input class="item_input" type="text" name="address" id="address">
    </div>
    <div class="total_row">
      <button id="order"  class="confirm-button">Order</button>
    </div>
  </div>
  `
    : `
  <div class="centered">
    <div class="item_input col">
        <div style="padding-bottom: 1rem;text-align:center">Please add Address below:</div>
        <input class="item_input" type="text" name="address" id="address">
    </div>
    <div class="total_row">
      <button id="order" class="confirm-button">Order</button>
    </div>
  </div>
  `;
};

var modal = document.getElementById("myModal");
var span = document.getElementsByClassName("close")[0];

function genCart() {
  let cartBody = $("#cart_body");
  cartBody.html("");
  let data = Cookies.get("cart");
  data = JSON.parse(data === undefined ? "{}" : data);
  let inCart = products.filter((item) => data[item.id] > 0);
  let total = 0;
  inCart.forEach((element) => {
    total += data[element.id] * element.price;
    cartBody.html(cartBody.html() + cartRow(element, data[element.id]));
  });
  $("#cart_total").html(toFixed(total));
}

function preview(event) {
  let row = event.path[0].tagName === "TD" ? event.path[1] : event.path[0];
  let rowId = row.getAttribute("item-id");
  let product = products.find((item) => item.id === rowId);
  if (!$(".preview").is(":visible")) {
    $("#modal-content").html(block(product));
    modal.style.opacity = "1";
    modal.style.zIndex = "2";
  } else {
    $(".preview").html(block(product));
  }
  loadProductFunction(genCart);
}

function inputAddress() {
  $("#modal-content").html(inputForm());
  modal.style.opacity = "1";
  modal.style.zIndex = "2";
}

function checkNullInput() {
  console.log("hi");
  let checked = true;
  $("input[type!='file']").each(function () {
    if (checkNull($(this).val())) {
      checked = false;
      $(this).toggleClass("error-border", true);
    } else {
      $(this).toggleClass("error-border", false);
    }
  });
  return checked;
}

$(document).ready(() => {
  genCart();

  span.onclick = function () {
    modal.style.opacity = "0";
    modal.style.zIndex = "-1";
  };
  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.opacity = "0";
      modal.style.zIndex = "-1";
    }
  };

  $("#confirm").on("click", (e) => {
    inputAddress();
    $("#order").on("click", (e) => {
      let address = $("#address").val();
      if (checkNullInput()) {
        let data = Cookies.get("cart");
        data = JSON.parse(data === undefined ? "{}" : data);
        for (const key in data) {
          if (data[key] === 0) delete data[key];
        }
        var cartData;
        if (user_id === -1) {
          let name = $("#name").val();
          let phone = $("#phone").val();
          cartData = {
            data: data,
            address: address,
            name: name,
            phone: phone,
            user_id: user_id,
          };
        } else {
          cartData = {
            data: data,
            address: address,
            user_id: user_id,
          };
        }
        $("#modal-content").html(roller());
        $.ajax({
          type: "POST",
          url: "index.php?controller=UserCart&action=order",
          data: cartData,
          success: function (data, status) {
            data = JSON.parse(data);
            console.log(data);
            if (data.status === 200) {
              // Cookies.remove("cart");
              $("#modal-content").html(updateStatus(data.message));
            } else {
              $("#modal-content").html(updateStatus(data.message));
            }
            $("#close-modal").on("click", () => {
              modal.style.opacity = "0";
              modal.style.zIndex = "-1";
            });
          },
        });
      }
    });
  });
});
