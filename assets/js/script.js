// // document.addEventListener("DOMContentLoaded", function () {
// //   const lineElements = document.querySelectorAll(".line");

// //   const observer = new IntersectionObserver(
// //     (entries) => {
// //       entries.forEach((entry) => {
// //         if (entry.isIntersecting) {
// //           entry.target.classList.add("animate");
// //         } else {
// //           entry.target.classList.remove("animate");
// //         }
// //       });
// //     },
// //     {
// //       threshold: 0.5,
// //     }
// //   );

// //   lineElements.forEach((line) => {
// //     observer.observe(line);
// //   });
// // });

// // animasi gambar tentang kami
// document.addEventListener('DOMContentLoaded', function() {
//   const image = document.querySelector(".gambar-tentangkami");

//   const observer = new IntersectionObserver((entries) => {
//       entries.forEach(entry => {
//           if (entry.isIntersecting) {
//               image.classList.add('animate');
//           } else {
//               image.classList.remove('animate');
//           }
//       });
//   }, {
//       threshold: 0.1 // Adjust this value as needed
//   });

//   observer.observe(image);
// });

// document.addEventListener('DOMContentLoaded', function() {
//   var showMoreBtn = document.querySelector('.show-more-btn');
//   var dots = document.querySelector('.dots');
//   var moreText = document.querySelector('.more-text');

//   showMoreBtn.addEventListener('click', function() {
//       if (moreText.style.display === 'none') {
//           moreText.style.display = 'inline';
//           dots.style.display = 'none';
//           showMoreBtn.textContent = 'lebih sedikit';
//       } else {
//           moreText.style.display = 'none';
//           dots.style.display = 'inline';
//           showMoreBtn.textContent = 'selengkapnya';
//       }
//   });
// });

// // ini untuk heading

// document.addEventListener("DOMContentLoaded", function () {
//   const elementsToAnimate = document.querySelectorAll("h1, h2, h3, .line");

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

//   elementsToAnimate.forEach((element) => {
//     observer.observe(element);
//   });
// });

// document.addEventListener("DOMContentLoaded", function () {
//   const paragraphsToAnimate = document.querySelectorAll("p");
//   const hasAnimated = localStorage.getItem("hasAnimated");

//   if (!hasAnimated) {
//     const observer = new IntersectionObserver(
//       (entries) => {
//         entries.forEach((entry) => {
//           if (entry.isIntersecting) {
//             entry.target.classList.add("animate");
//             localStorage.setItem("hasAnimated", "true");
//           }
//         });
//       },
//       {
//         threshold: 0.5,
//       }
//     );

//     paragraphsToAnimate.forEach((paragraph) => {
//       observer.observe(paragraph);
//     });
//   } else {
//     paragraphsToAnimate.forEach((paragraph) => {
//       paragraph.classList.add("animate");
//     });
//   }
// });

// // ini untuk navigasi mobile
// document.addEventListener("DOMContentLoaded", function () {
//   const toggler = document.querySelector(".navbar-toggler");
//   const barsIcon = document.querySelector(".fa-bars");
//   const timesIcon = document.querySelector(".fa-times");
//   const nav = document.querySelector(".navbar-nav");

//   let isToggling = false; // Flag to avoid inconsistent toggling

//   toggler.addEventListener("click", function () {
//     if (isToggling) return; // Do nothing if already toggling

//     isToggling = true; // Mark as toggling

//     // Add a class to prevent toggling while animation is running
//     toggler.classList.add("no-toggle");

//     // Toggle classes
//     toggler.classList.toggle("active");
//     barsIcon.classList.toggle("d-none");
//     timesIcon.classList.toggle("d-none");
//     nav.classList.toggle("active");

//     // Remove the no-toggle class after animation duration
//     setTimeout(() => {
//       isToggling = false;
//       toggler.classList.remove("no-toggle");
//     }, 300); // Adjust according to your animation duration
//   });
// });

// // marquee kerjasama

// function Marquee(selector, speed) {
//   const parentSelector = document.querySelector(selector);
//   const clone = parentSelector.innerHTML;
//   const firstElement = parentSelector.children[0];
//   let i = 0;
//   console.log(firstElement);
//   parentSelector.insertAdjacentHTML("beforeend", clone);
//   parentSelector.insertAdjacentHTML("beforeend", clone);

//   setInterval(function () {
//     firstElement.style.marginLeft = `-${i}px`;
//     if (i > firstElement.clientWidth) {
//       i = 0;
//     }
//     i = i + speed;
//   }, 0);
// }

// //after window is completed load
// //1 class selector for marquee
// //2 marquee speed 0.2
// window.addEventListener("load", Marquee(".marquee", 0.2));

// // validasi inut pesan landing page footer
// function validateForm() {
//   var pesan = document.getElementById("pesan").value;
//   var email = document.getElementById("email").value;

//   // Basic XSS protection by sanitizing input
//   var regex = /<\/?[^>]+(>|$)/g;
//   if (regex.test(pesan)) {
//       Swal.fire({
//         icon: "error",
//         title: "Pesan tidak valid",
//         text: "Pesan mengandung karakter tidak valid.",
//         confirmButtonText: "OK",
//       });
//       return false;
//   }

//   // Basic email format validation
//   var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//   if (!emailPattern.test(email)) {
//       Swal.fire({
//         icon: "error",
//         title: "Email tidak valid",
//         text: "Format email tidak valid.",
//         confirmButtonText: "OK",
//       });
//       return false;
//   }

//   return true;
// }

// // dropdown
// function toggleDropdown(event) {
//   event.preventDefault();
//   const dropdown = event.target.closest(".dropdown");
//   const dropdownMenu = dropdown.querySelector(".dropdown-menu");
//   const dropdownIcon = dropdown.querySelector(".dropdown-icon");

//   // Toggle current dropdown
//   if (dropdown.classList.contains("open")) {
//     dropdown.classList.remove("open");
//     dropdownMenu.style.display = "none";
//   } else {
//     document.querySelectorAll(".dropdown").forEach((item) => {
//       item.classList.remove("open");
//       item.querySelector(".dropdown-menu").style.display = "none";
//     });
//     dropdown.classList.add("open");
//     dropdownMenu.style.display = "block";
//   }
// }

// window.onclick = function (event) {
//   if (
//     !event.target.matches(".nav-link") &&
//     !event.target.matches(".dropdown-icon")
//   ) {
//     document.querySelectorAll(".dropdown").forEach((item) => {
//       item.classList.remove("open");
//       item.querySelector(".dropdown-menu").style.display = "none";
//     });
//   }
// };

// // text expandable card pada produk kami
// // document.addEventListener('DOMContentLoaded', function() {
// //   const toggleButtons = document.querySelectorAll(".toggle-btn");
// //   const collapseElements = document.querySelectorAll(".collapse");

// //   // Function to close all collapse elements except the clicked one
// //   function closeAllCollapses(exceptElement = null) {
// //     collapseElements.forEach((collapse) => {
// //       if (collapse !== exceptElement) {
// //         const collapseInstance =
// //           bootstrap.Collapse.getOrCreateInstance(collapse);
// //         collapseInstance.hide();
// //       }
// //     });
// //   }

// //   // Event listener for toggle buttons
// //   toggleButtons.forEach((button) => {
// //     button.addEventListener("click", function () {
// //       const target = this.getAttribute("data-bs-target");
// //       const targetElement = document.querySelector(target);

// //       // Close all collapse elements except the target
// //       closeAllCollapses(targetElement);

// //       // Toggle the target collapse
// //       const targetCollapse =
// //         bootstrap.Collapse.getOrCreateInstance(targetElement);
// //       targetCollapse.toggle();

// //       // Update the icon
// //       const icon = this.querySelector("i");
// //       if (targetCollapse._isShown()) {
// //         icon.classList.replace("fa-eye", "fa-eye-slash");
// //       } else {
// //         icon.classList.replace("fa-eye-slash", "fa-eye");
// //       }
// //     });
// //   });
// // });
