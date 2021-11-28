function modal_block(data) {
  return `
          <div class="item_image">
            <img
              src="${data.image}"
              alt="Hinh san pham ${data.name}"
            />
          </div>
          <div class="item_content">
            <div class="item_title">${data.name}</div>
            <div class="item_price">${data.price}</div>
            <div class="item_volume">${data.volume}</div>
            <div class="item_des">
              ${data.description}
            </div>
          </div>
    `;
}

$(document).ready(() => {
  // Cookies.remove("cart");

  var modal = document.getElementById("myModal");
  var span = document.getElementsByClassName("close")[0];
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

  data.forEach((element) => {
    $(".container").html($(".container").html() + block(element));
  });

  loadProductFunction();

  $(".item").each(function (index, element) {
    $(element)
      .children(".item_image")
      .on("click", () => {
        let id = $(element).attr("item-id");
        let modal_data = data.find((item) => item.id === id);
        console.log(data);
        $("#modal-content").html(modal_block(modal_data));
        modal.style.opacity = "1";
        modal.style.zIndex = "2";
      });
  });
});
