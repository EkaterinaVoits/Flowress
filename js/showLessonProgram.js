let x = document.getElementsByClassName("lesson-item");
for (let i = 0; i < x.length; i++) {
  x[i].addEventListener("click", function () {

        this.classList.toggle("active");

        var block = this.nextElementSibling;

        if (block.style.display === "block") {
          block.style.display = "none";
        } else {
          block.style.display = "block";
        }
      });
}