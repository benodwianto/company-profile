// document.addEventListener("DOMContentLoaded", function () {
//   const lineElements = document.querySelectorAll(".line");

//   const observer = new IntersectionObserver(
//     (entries) => {
//       entries.forEach((entry) => {
//         if (entry.isIntersecting) {
//           entry.target.classList.add("animate");
//         } else {
//           entry.target.classList.remove("animate");
//         }
//       });
//     },
//     {
//       threshold: 0.5,
//     }
//   );

//   lineElements.forEach((line) => {
//     observer.observe(line);
//   });
// });

// ini untuk heading

document.addEventListener("DOMContentLoaded", function () {
  const elementsToAnimate = document.querySelectorAll("h1, h2, h3, .line");

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("animate");
        } else {
          entry.target.classList.remove("animate");
        }
      });
    },
    {
      threshold: 0.5,
    }
  );

  elementsToAnimate.forEach((element) => {
    observer.observe(element);
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const paragraphsToAnimate = document.querySelectorAll("p");

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("animate");
        } else {
          entry.target.classList.remove("animate");
        }
      });
    },
    {
      threshold: 0.5,
    }
  );

  paragraphsToAnimate.forEach((paragraph) => {
    observer.observe(paragraph);
  });
});

// ini untuk navigasi mobile
document.addEventListener("DOMContentLoaded", function () {
  const toggler = document.querySelector(".navbar-toggler");
  const barsIcon = document.querySelector(".fa-bars");
  const timesIcon = document.querySelector(".fa-times");
  const nav = document.querySelector(".navbar-nav");

  toggler.addEventListener("click", function () {
    toggler.classList.toggle("active");
    barsIcon.classList.toggle("d-none");
    timesIcon.classList.toggle("d-none");
    nav.classList.toggle("active");
  });
});
