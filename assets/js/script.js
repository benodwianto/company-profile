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

// animasi gambar tentang kami
document.addEventListener('DOMContentLoaded', function() {
  const image = document.querySelector('.gambar-tentangkami');

  const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
          if (entry.isIntersecting) {
              image.classList.add('animate');
          } else {
              image.classList.remove('animate');
          }
      });
  }, {
      threshold: 0.1 // Adjust this value as needed
  });

  observer.observe(image);
});


document.addEventListener('DOMContentLoaded', function() {
  var showMoreBtn = document.querySelector('.show-more-btn');
  var dots = document.querySelector('.dots');
  var moreText = document.querySelector('.more-text');

  showMoreBtn.addEventListener('click', function() {
      if (moreText.style.display === 'none') {
          moreText.style.display = 'inline';
          dots.style.display = 'none';
          showMoreBtn.textContent = 'lebih sedikit';
      } else {
          moreText.style.display = 'none';
          dots.style.display = 'inline';
          showMoreBtn.textContent = 'selengkapnya';
      }
  });
});

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
  const hasAnimated = localStorage.getItem("hasAnimated");

  if (!hasAnimated) {
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("animate");
            localStorage.setItem("hasAnimated", "true");
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
  } else {
    paragraphsToAnimate.forEach((paragraph) => {
      paragraph.classList.add("animate");
    });
  }
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

// marquee kerjasama

function Marquee(selector, speed) {
  const parentSelector = document.querySelector(selector);
  const clone = parentSelector.innerHTML;
  const firstElement = parentSelector.children[0];
  let i = 0;
  console.log(firstElement);
  parentSelector.insertAdjacentHTML('beforeend', clone);
  parentSelector.insertAdjacentHTML('beforeend', clone);

  setInterval(function () {
    firstElement.style.marginLeft = `-${i}px`;
    if (i > firstElement.clientWidth) {
      i = 0;
    }
    i = i + speed;
  }, 0);
}

//after window is completed load
//1 class selector for marquee
//2 marquee speed 0.2
window.addEventListener('load', Marquee('.marquee', 0.2))

