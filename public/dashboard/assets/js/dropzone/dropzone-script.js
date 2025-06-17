/**=====================
    Custom Dropzone  Start
==========================**/
(function () {
  var DropzoneExample = (function () {
    var DropzoneDemos = function () {
      Dropzone.options.singleFileUpload = {
        paramName: "file",
        maxFiles: 1,
        maxFilesize: 5,
        addRemoveLinks: true,
        accept: function (file, done) {
          if (file.name == "justinbieber.jpg") {
            done("Naha, you don't.");
          } else {
            done();
          }
        },
      };
      Dropzone.options.multiFileUpload = {
        paramName: "file",
        maxFiles: 10,
        maxFilesize: 10,
        addRemoveLinks: true,
        accept: function (file, done) {
          if (file.name == "justinbieber.jpg") {
            done("Naha, you don't.");
          } else {
            done();
          }
        },
      };
      Dropzone.options.fileTypeValidation = {
        paramName: "file",
        maxFiles: 10,
        maxFilesize: 10,
        addRemoveLinks: true,
        acceptedFiles: "image/*,application/pdf,.psd",
        accept: function (file, done) {
          if (file.name == "justinbieber.jpg") {
            done("Naha, you don't.");
          } else {
            done();
          }
        },
      };
    };
    return {
      init: function () {
        DropzoneDemos();
      },
    };
  })();

  DropzoneExample.init();

  // Only pics upload with animation
  $("#fileup").change(function () {
    //here we take the file extension and set an array of valid extensions
    var res = $("#fileup").val();
    var arr = res.split("\\");
    var filename = arr.slice(-1)[0];
    filextension = filename.split(".");
    filext = "." + filextension.slice(-1)[0];
    valid = [".jpg", ".png", ".jpeg", ".bmp"];
    //if file is not valid we show the error icon, the red alert, and hide the submit button
    if (valid.indexOf(filext.toLowerCase()) == -1) {
      $(".imgupload").hide("slow");
      $(".imgupload.ok").hide("slow");
      $(".imgupload.stop").show("slow");

      $("#namefile").css({ color: "#FC4438", "font-weight": 700 });
      $("#namefile").html("File " + filename + " is not  pic!");

      $("#submitbtn").hide();
      $("#fakebtn").show();
    } else {
      //if file is valid we show the green alert and show the valid submit
      $(".imgupload").hide("slow");
      $(".imgupload.stop").hide("slow");
      $(".imgupload.ok").show("slow");

      $("#namefile").css({ color: "#54BA4A", "font-weight": 700 });
      $("#namefile").html(filename);

      $("#submitbtn").show();
      $("#fakebtn").hide();
    }
  });
})();

/**=====================
    Custom Dropzone Ends
==========================**/
