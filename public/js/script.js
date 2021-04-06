function toggleForm() {
    var x = document.getElementById("filter-form");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
}

function toggleElement() {  // only on Mozilla ???
  var x = document.getElementById("src");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}