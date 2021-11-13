function checkNull(input) {
  return input === null || input === "";
}

function checkEmail(input) {
  let mailRegex =
    /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
  return mailRegex.test(input);
}

function checkPhone(input) {
  return !(
    input.match(/0[0-9]{9,10}/g) == null ||
    input.match(/0[0-9]{9,10}/g)[0].length != input.length
  );
}
