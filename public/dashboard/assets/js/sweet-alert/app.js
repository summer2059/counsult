/**=====================
    Sweet-alert Start
==========================**/

(function () {
  var SweetAlert_custom = {
    init: function () {
      (document.querySelector(".sweet-1").onclick = function () {
        Swal.fire("Welcome! to the mofi theme!");
      }),
        (document.querySelector(".sweet-2").onclick = function () {
          Swal.fire({
            title: "The Internet?",
            text: "That thing is still around?",
            icon: "question",
          });
        }),
        (document.querySelector(".sweet-2").onclick = function () {
          Swal.fire({
            title: "The Internet?",
            text: "That thing is still around?",
            icon: "question",
          });
        }),
        (document.querySelector(".sweet-3").onclick = function () {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
            footer: '<a href="#">Why do I have this issue?</a>',
          });
        }),
        (document.querySelector(".sweet-4").onclick = function () {
          Swal.fire({
            title: "<strong>HTML <u>example</u></strong>",
            icon: "info",
            html: `
              You can use <b>bold text</b>,
              <a href="#">links</a>,
              and other HTML tags
            `,
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: `
              <i class="fa fa-thumbs-up"></i> Great!
            `,
            confirmButtonAriaLabel: "Thumbs up, great!",
            cancelButtonText: `
              <i class="fa fa-thumbs-down"></i>
            `,
            cancelButtonAriaLabel: "Thumbs down",
          });
        }),
        (document.querySelector(".sweet-5").onclick = function () {
          Swal.fire({
            title: "Do you want to save the changes?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Save",
            denyButtonText: `Don't save`,
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire("Saved!", "", "success");
            } else if (result.isDenied) {
              Swal.fire("Changes are not saved", "", "info");
            }
          });
        }),
        (document.querySelector(".sweet-6").onclick = function () {
          Swal.fire({
            title: "Custom animation with Animate.css",
            showClass: {
              popup: `
                animate__animated
                animate__fadeInUp
                animate__faster
              `,
            },
            hideClass: {
              popup: `
                animate__animated
                animate__fadeOutDown
                animate__faster
              `,
            },
          });
        }),
        (document.querySelector(".sweet-7").onclick = function () {
          Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire({
                title: "Deleted!",
                text: "Your file has been deleted.",
                icon: "success",
              });
            }
          });
        }),
        (document.querySelector(".sweet-8").onclick = function () {
          Swal.fire({
            title: "Sweet!",
            text: "Modal with a custom image.",
            imageUrl: "https://unsplash.it/400/200",
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: "Custom image",
          });
        }),
        (document.querySelector(".sweet-9").onclick = function () {
          let timerInterval;
          Swal.fire({
            title: "Auto close alert!",
            html: "I will close in <b></b> milliseconds.",
            timer: 2000,
            timerProgressBar: true,
            didOpen: () => {
              Swal.showLoading();
              const timer = Swal.getPopup().querySelector("b");
              timerInterval = setInterval(() => {
                timer.textContent = `${Swal.getTimerLeft()}`;
              }, 100);
            },
            willClose: () => {
              clearInterval(timerInterval);
            },
          }).then((result) => {
            if (result.dismiss === Swal.DismissReason.timer) {
              console.log("I was closed by the timer");
            }
          });
        }),
        (document.querySelector(".sweet-10").onclick = function () {
          Swal.fire({
            title: "Submit your Github username",
            input: "text",
            inputAttributes: {
              autocapitalize: "off",
            },
            showCancelButton: true,
            confirmButtonText: "Look up",
            showLoaderOnConfirm: true,
            preConfirm: async (login) => {
              try {
                const githubUrl = `
                  https://api.github.com/users/${login}
                `;
                const response = await fetch(githubUrl);
                if (!response.ok) {
                  return Swal.showValidationMessage(`
                    ${JSON.stringify(await response.json())}
                  `);
                }
                return response.json();
              } catch (error) {
                Swal.showValidationMessage(`
                  Request failed: ${error}
                `);
              }
            },
            allowOutsideClick: () => !Swal.isLoading(),
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire({
                title: `${result.value.login}'s avatar`,
                imageUrl: result.value.avatar_url,
              });
            }
          });
        }),
        (document.querySelector(".sweet-11").onclick = function () {
          const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: "btn btn-success",
              cancelButton: "btn btn-danger text-white",
            },
            buttonsStyling: false,
          });
          swalWithBootstrapButtons
            .fire({
              title: "Are you sure?",
              text: "You won't be able to revert this!",
              icon: "warning",
              showCancelButton: true,
              confirmButtonText: "Yes, delete it!",
              cancelButtonText: "No, cancel!",
              reverseButtons: true,
            })
            .then((result) => {
              if (result.isConfirmed) {
                swalWithBootstrapButtons.fire({
                  title: "Deleted!",
                  text: "Your file has been deleted.",
                  icon: "success",
                });
              } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
              ) {
                swalWithBootstrapButtons.fire({
                  title: "Cancelled",
                  text: "Your imaginary file is safe :)",
                  icon: "error",
                });
              }
            });
        }),
        (document.querySelector(".sweet-12").onclick = function () {
          Swal.fire({
            title: "هل تريد الاستمرار؟",
            icon: "question",
            iconHtml: "؟",
            confirmButtonText: "نعم",
            cancelButtonText: "لا",
            showCancelButton: true,
            showCloseButton: true,
          });
        });

      document.querySelector(".sweet-13").onclick = async function () {
        const { value: password } = await Swal.fire({
          title: "Enter your password",
          input: "password",
          inputLabel: "Password",
          inputPlaceholder: "Enter your password",
          inputAttributes: {
            maxlength: "10",
            autocapitalize: "off",
            autocorrect: "off",
          },
        });
        if (password) {
          Swal.fire(`Entered password: ${password}`);
        }
      };
      document.querySelector(".sweet-14").onclick = async function () {
        const { value: date } = await Swal.fire({
          title: "select departure date",
          input: "date",
          didOpen: () => {
            const today = new Date().toISOString();
            Swal.getInput().min = today.split("T")[0];
          },
        });
        if (date) {
          Swal.fire("Departure date", date);
        }
      };
      document.querySelector(".sweet-15").onclick = async function () {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          },
        });
        Toast.fire({
          icon: "success",
          title: "Signed in successfully",
        });
      };
      document.querySelector(".sweet-16").onclick = async function () {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-start",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          },
        });
        Toast.fire({
          icon: "success",
          title: "Signed in successfully",
        });
      };
      document.querySelector(".sweet-17").onclick = async function () {
        const Toast = Swal.mixin({
          toast: true,
          position: "bottom-start",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          },
        });
        Toast.fire({
          icon: "success",
          title: "Signed in successfully",
        });
      };
      document.querySelector(".sweet-18").onclick = async function () {
        const Toast = Swal.mixin({
          toast: true,
          position: "bottom-end",
          showConfirmButton: false,
          timer: 3000000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          },
        });
        Toast.fire({
          icon: "success",
          title: "Signed in successfully",
        });
      };
      document.querySelector(".sweet-19").onclick = async function () {
        Swal.fire({
          position: "top-end",
          icon: "success",
          title: "Your work has been saved",
          showConfirmButton: false,
          timer: 1500,
        });
      };
      document.querySelector(".sweet-20").onclick = async function () {
        const { value: formValues } = await Swal.fire({
          title: "Registration Form",
          html:
            '<div class="swal2-wrapper">' +
            '<div class="mb-3">' +
            ' <label for="swal-input-email" class="form-label">Email address:</label>' +
            ' <input id="swal-input-email" class="swal2-input form-control" placeholder="Enter your email address">' +
            "</div>" +
            '<div class="mb-3">' +
            '<label for="swal-input-password" class="form-label">Your password:</label>' +
            '<input type="password" id="swal-input-password" class="swal2-input form-control" placeholder="Enter your password">' +
            "</div>" +
            '<div class="swal2-select">' +
            '<label for="swal-input-select" class="form-label">Select Country:</label>' +
            '<select id="swal-input-select" class="swal2-input form-select">' +
            '  <option value="India">India</option>' +
            '  <option value="US">US</option>' +
            '  <option value="UK">UK</option>' +
            '  <option value="Africa">Africa</option>' +
            "</select>" +
            "</div>" +
            '<div class="swal2-genders">' +
            '<label for="swal-input-radio">Gender : </label>' +
            '<div id="swal-input-radio" class="swal2-radio-group">' +
            '  <input type="radio" id="radio-male" class="form-check-input checkbox-primary" name="swal-radio" value="Male">' +
            '  <label for="radio-male">Male</label>' +
            '  <input type="radio" id="radio-female" class="form-check-input checkbox-primary ms-2" name="swal-radio" value="Female">' +
            '  <label for="radio-female">Female</label>' +
            "</div>" +
            "</div>" +
            '<div class="swal2-checkbox justify-content-start">' +
            '<input type="checkbox" id="swal-input-accept" class="form-check-input checkbox-primary mx-0">' +
            '<label for="swal-input-accept" class="f-16 mx-0">I accept the terms and conditions.</label>' +
            "</div>" +
            "</div>",
          focusConfirm: false,
          preConfirm: () => {
            return [document.getElementById("swal-input-email").value, document.getElementById("swal-input-password").value, document.getElementById("swal-input-select").value, document.querySelector('input[name="swal-radio"]:checked').value, document.getElementById("swal-input-accept").checked];
          },
        });

        if (formValues) {
          const [email, password, country, gender, accept] = formValues;
          Swal.fire(`
            Entered email: ${email}
            Entered password: ${password}
            Selected country: ${country}
            Selected gender: ${gender}
            Agreed with T&C: ${accept ? "Yes" : "No"}
          `);
        }
      };
    },
  };

  SweetAlert_custom.init();
})();

/**=====================
  Sweet-alert Ends
==========================**/
