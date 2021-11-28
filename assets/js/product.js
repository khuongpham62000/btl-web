function block(data) {
  return `
      <div class="item col" item-id="${data.id}">
        <div class="item_image">
          <img
            src="${data.image}"
            alt="Hinh san pham ${data.name}"
          />
          <div class="overlay">0</div>
        </div>
        <div class="item_content col">
          <div class="row">
            <div class="item_title">${data.name}</div>
            <div class="col">
              <div class="item_price">${data.price}</div>
              <div class="item_volume">${data.volume}</div>
            </div>
          </div>
          <div class="item_des">
            ${data.description}
          </div>
          <div class="item_input">
            <div class="item_input-text">Bottle</div>
            <input type="number" placeholder="1" />
          </div>
        </div>
        <div class="row">
          <button class="item_remove"></button>
          <button class="item_add">Add to cart</button>
        </div>
      </div>
    `;
}

function loadProductFunction(changeItemStateCallBack = () => {}) {
  function changeItemState(element, value) {
    let data = Cookies.get("cart");
    data = JSON.parse(data === undefined ? "{}" : data);
    let item = element.attr("item-id");
    if (data[item] === undefined) data[item] = value > 0 ? value : 0;
    else data[item] = data[item] + value > 0 ? data[item] + value : 0;
    Cookies.set("cart", JSON.stringify(data));

    let overlay = element.children(".item_image").children(".overlay");
    let remove_btn = element.children(".row").children(".item_remove");
    overlay.html(data[item]);
    if (!remove_btn.is(":visible") && data[item] !== 0) remove_btn.toggle(300);
    if (overlay.css("opacity") === "0" && data[item] !== 0) {
      overlay.css("opacity", "1");
    } else if (data[item] === 0) {
      overlay.css("opacity", "0");
      if (remove_btn.is(":visible")) remove_btn.toggle(300);
    }
    changeItemStateCallBack();
    return data[item];
  }

  $(".item").each(function (index, element) {
    changeItemState($(element), 0);
    let input = $(element)
      .children(".item_content")
      .children(".item_input")
      .children("input");

    $(element)
      .children(".row")
      .children(".item_add")
      .on("click", () => {
        if (input.val() === "") changeItemState($(this), 1);
        else changeItemState($(this), parseInt(input.val()));
        console.log(JSON.parse(Cookies.get("cart")));
      });

    $(element)
      .children(".row")
      .children(".item_remove")
      .on("click", () => {
        if (input.val() === "") changeItemState($(this), -1);
        else changeItemState($(this), -parseInt(input.val()));
        console.log(JSON.parse(Cookies.get("cart")));
      });
  });
}
