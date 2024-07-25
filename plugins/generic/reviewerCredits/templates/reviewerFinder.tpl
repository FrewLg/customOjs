{** * plugins/generic/reviewerCredits/templates/reviewerFinder.tpl * * Copyright
(c) 2015-2018 University of Pittsburgh * Copyright (c) 2014-2018 Simon Fraser
University * Copyright (c) 2003-2018 John Willinsky * Distributed under the GNU
GPL v2. For full terms see the file docs/COPYING. * * Template for the
ReviewerCredits plugin *}

<style>
  @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap");

  .rc-finder-title {
    font-size: 1.5em;
    font-weight: bolder;
    letter-spacing: 1px;
    margin: 10px 0px;
    text-align: center;
  }

  .popupOverlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    display: none;
  }

  .popupContainer {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    max-height: 80%;
    width: 80%;
    overflow-y: auto;
    z-index: 1001;
    background-color: white;
    border: 1px solid #000;
    padding: 10px;
    display: none;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    font-family: "Nunito", sans-serif;
  }

  .flex-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
  }

  .box {
    width: 350px;
    min-height: max-content;
    border-radius: 20px;
    padding: 10px;
    text-align: center;
    background: #ededed;
    margin-top: 10px;
    margin-bottom: 10px;
    position: relative;
    padding-bottom: 150px;
  }

  .box1 {
    margin-top: 10px;
    margin-bottom: 10px;
  }

  .content {
    margin: 15px 2px;
  }

  .image img {
    height: auto;
    width: 120px;
    border-radius: 50%;

    display: block;
    margin-left: auto;
    margin-right: auto;
    margin-bottom: 5px;
  }

  .level {
    font-size: 0.7em;
    background-color: rgb(164, 189, 183, 0.5);
    width: 50px;
    padding: 3px;
    border-radius: 5px;
    font-weight: bolder;
    letter-spacing: 1px;

    display: block;
    margin: 0px auto 10px;
  }

  .name {
    font-size: 1.25em;
    font-weight: bolder;
    letter-spacing: 1px;
    margin: auto;
  }

  .job_title {
    font-size: 0.9em;
    font-weight: bolder;
    color: gray;
    margin: auto;
  }

  .job_discription {
    font-size: 0.9em;
    color: gray;
    margin: auto;
  }

  .icons {
    margin: 0px 30px;
    font-size: 1.5em;
    display: flex;
    justify-content: space-around;
  }

  .icons button {
    width: fit-content;
    height: fit-content;
    border: none;
    font-size: 1em;
  }

  ion-icon:hover {
    color: #58a497;
    transition: 0.5s;
  }

  .rc-finder-button button {
    width: 125px;
    min-height: 45px;
    border-radius: 10px;
    font-weight: bolder;
  }

  .rc-finder-button {
    position: absolute; /* Absolute positioning */
    bottom: 20px; /* Positioned 10px above the bottom of the box */
    left: 0;
    right: 0;
    display: flex;
    justify-content: space-around;
    flex-direction: row;
  }

  .rc-finder-button .orcid-button {
    background: #ededed;
    border: 2px solid #000;
    cursor: pointer;
  }

  .rc-finder-button .orcid-button:disabled {
    background: #ededed;
    border: 2px solid #ccc;
    cursor: not-allowed;
  }

  .rc-finder-button .orcid-button:disabled:hover {
    background: #ededed;
    border: 2px solid #ccc;
    cursor: not-allowed;
  }

  .rc-finder-button .save-button {
    background-color: #0e4f8c;
    color: #ededed;
    border: none;
    cursor: pointer;
  }

  .rc-finder-button .save-button:hover {
    letter-spacing: 1px;
    transition: 0.5s;
  }

  .rc-finder-button .save-button:disabled {
    background-color: #b71d18;
    color: #ededed;
    cursor: not-allowed;
  }

  .rc-finder-button .save-button:disabled:hover {
    cursor: not-allowed;
  }

  .rc-finder-button .saved-button {
    background-color: #44803f;
    color: #ededed;
    border: none;
  }

  .rc-finder-button .saved-button:hover {
    letter-spacing: 1px;
    transition: 0.5s;
  }

  .rc-finder-button .orcid-button:hover {
    letter-spacing: 1px;
    transition: 0.5s;
    background: rgba(88, 164, 151, 0.5);
  }

  .row {
    position: absolute;
    bottom: 85px;
    left: 0;
    right: 0;
    display: flex;
    justify-content: space-around;
    align-items: center;
  }

  .row p {
    margin: auto;
    font-size: 1.2em;
  }

  /* Content-1:End */

  /* Responsiveness:Start */
  @media screen and (max-width: 480px) {
    .box {
      width: 100vw;
      border-radius: 0px;
    }

    .rc-finder-button {
      display: flex;
      flex-direction: column;
    }

    .rc-finder-button button {
      width: 250px;
    }

    button.save-button {
      margin-top: 10px;
    }
  }

  /* Responsiveness:End */

</style>

<script>
  var baseImgUrl = "{$baseUrl}";
</script>

{literal}
<script>
  $(function () {
    var observer = new MutationObserver(function (mutations) {
      mutations.forEach(function (mutation) {
        if (mutation.addedNodes && mutation.addedNodes.length > 0) {
          mutation.addedNodes.forEach(function (node) {
            if (
              $(node).is(
                '[id*="component-grid-users-stageparticipant-stageparticipantgrid"]'
              ) &&
              !$(node).data("reviewerSetupDone")
            ) {
              setupReviewerFinder(node);
            }
          });
        }
      });
    });

    observer.observe(document.body, {
      childList: true,
      subtree: true,
    });
    var reviewersData = null;

    function getSubmissionIdFromUrl() {
      var path = window.location.pathname;
      var segments = path.split("/");
      return segments[segments.length - 2];
    }

    function baseUrl() {
      var basePath = window.location.href.split("workflow")[0];
      return basePath;
    }

    function openPopup() {
      var submissionId = getSubmissionIdFromUrl();
      if (reviewersData) {
        displayReviewersData();
      } else {
        $("#openPopupBtn")
          .prop("disabled", true)
          .after(
            '<span class="pkp_loading small"><span class="pkp_spinner"></span></span>'
          );
        $.ajax({
          url:
            baseUrl() +
            "$$$call$$$/grid/settings/plugins/settings-plugin-grid/manage",
          type: "POST",
          data: {
            verb: "reviewerFinder",
            plugin: "reviewercreditsplugin",
            category: "generic",
            submissionId: submissionId,
          },
          success: function (response) {
            $(".pkp_loading").remove();
            $("#openPopupBtn").prop("disabled", false);
            if (
              response.status &&
              response.content &&
              response.content.payload &&
              response.content.payload.length > 0
            ) {
              reviewersData = response.content.payload;
              displayReviewersData();
            } else if (response.content.tokenError) {
              var errorMessage = `
                    <div style="font-family: 'Nunito', sans-serif; text-align: center; margin-top: 20px; padding: 20px; background-color: #f8f9fa; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        <h3 style="color: #d9534f; font-size: 1.8em;">Authentication is Expired!</h3>
                        <p style="font-size: 1.2em; color: #333;">
                            Your Authentication credits might have <strong>expired</strong>, your Authentication rights are <strong>used up</strong>, or there could be a <strong>technical issue</strong>. 
                            Please check your journal <strong>username</strong> and <strong>password</strong> in the plugin settings.
                        </p>
                        <p style="font-size: 1.2em; margin-top: 15px; color: #555;">
                            If the issue persists, please contact the <strong>Reviewer Credits</strong> support team.
                        </p>
                        <button id="contactSupportBtn" class="pkp_button pkp_button_primary" style="margin-top: 20px; padding: 15px 30px; font-size: 1.2em; display: inline-flex; align-items: center;">
                            Get Credits <img src="${baseImgUrl}/plugins/generic/reviewerCredits/images/logo-short.png" alt="ReviewerCredits Logo" style="height: 30px; margin-right: 10px;">
                        </button>
                    </div>
                `;
              $("#popupContainer .flex-container").html(errorMessage);
              showPopup();

              $("#contactSupportBtn").on("click", function () {
                window.open(
                  "https://www.reviewercredits.com/general-contact-us-page/",
                  "_blank"
                );
              });
            } else if (response.content.emptyFields) { 
              const fields = response.content.emptyFields.split(',').map(field => `<b>${field.trim()}</b>`).join(', ');

              var errorMessage = `
                    <div style="font-family: 'Nunito', sans-serif; text-align: center; margin-top: 20px; padding: 20px; background-color: #f8f9fa; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        <h3 style="color: #d9534f; font-size: 1.8em;">Empty Fields!</h3>
                        <p style="font-size: 1.2em; margin-top: 15px; color: #555;">
                            The following fields are <strong>empty</strong>: ${fields}
                        </p>
                        <p style="font-size: 1.2em; margin-top: 15px; color: #555;">
                            You must fill the above fields in your system settings to use the <strong>Reviewer Credits</strong> plugin.
                        </p>
                        <p style="font-size: 1.2em; margin-top: 15px; color: #555;">
                            If the issue persists, please contact the <strong>Reviewer Credits</strong> support team.
                        </p>
                        <button id="contactSupportBtn" class="pkp_button pkp_button_primary" style="margin-top: 20px; padding: 15px 30px; font-size: 1.2em; display: inline-flex; align-items: center;">
                            Contact Support <img src="${baseImgUrl}/plugins/generic/reviewerCredits/images/logo-short.png" alt="ReviewerCredits Logo" style="height: 30px; margin-right: 10px;">
                        </button>
                    </div>
                `;
              $("#popupContainer .flex-container").html(errorMessage);
              showPopup();

              $("#contactSupportBtn").on("click", function () {
                window.open(
                  "https://www.reviewercredits.com/general-contact-us-page/",
                  "_blank"
                );
              });

            } else if (response.content.code == "RC400") {
              var errorMessage = `
                    <div style="font-family: 'Nunito', sans-serif; text-align: center; margin-top: 20px; padding: 20px; background-color: #f8f9fa; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        <h3 style="color: #d9534f; font-size: 1.8em;">Error!</h3>
                        <p style="font-size: 1.2em; color: #333;">
                            There was an <strong>error</strong> while fetching the data. Please try again later.
                        </p>
                        <p style="font-size: 1.2em; margin-top: 15px; color: #555;">
                            ${response.content.message}
                        </p>
                        <p style="font-size: 1.2em; margin-top: 15px; color: #555;">
                            You may also want to check your <strong>Reviewer Credits</strong> plugin settings. Because the error could be due to incorrect username and password.
                        </p>
                        <p style="font-size: 1.2em; margin-top: 15px; color: #555;">
                            If the issue persists, please contact the <strong>Reviewer Credits</strong> support team.
                        </p>
                        <button id="contactSupportBtn" class="pkp_button pkp_button_primary" style="margin-top: 20px; padding: 15px 30px; font-size: 1.2em; display: inline-flex; align-items: center;">
                            Contact Support <img src="${baseImgUrl}/plugins/generic/reviewerCredits/images/logo-short.png" alt="ReviewerCredits Logo" style="height: 30px; margin-right: 10px;">
                        </button>
                    </div>
                `;
              $("#popupContainer .flex-container").html(errorMessage);
              showPopup();

              $("#contactSupportBtn").on("click", function () {
                window.open(
                  "https://www.reviewercredits.com/general-contact-us-page/",
                  "_blank"
                );
              });
            } else if (
              response.content.payload.message ==
                "You have used your reviewer search limit. Please contact Reviewer Credits support team to get more." ||
              response.content.payload.code == "RC403"
            ) {
              var errorMessage = `
                    <div style="font-family: 'Nunito', sans-serif; text-align: center; margin-top: 20px; padding: 20px; background-color: #f8f9fa; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        <h3 style="color: #d9534f; font-size: 1.8em;">Search Limit Reached!</h3>
                        <p style="font-size: 1.2em; color: #333;">
                            You have <strong>used up</strong> your reviewer search limit. Please contact the <strong>Reviewer Credits</strong> support team to get more.
                        </p>
                        <p style="font-size: 1.2em; margin-top: 15px; color: #555;">
                            You can contact the support team by clicking <strong>Contact Support</strong>. Or if you want to get more credits, you can click the <strong>Subscription</strong>
                        </p>
                        <button id="contactSupportBtn" class="pkp_button pkp_button_primary" style="margin-top: 20px; padding: 15px 30px; font-size: 1.2em; display: inline-flex; align-items: center;">
                            Contact Support <img src="${baseImgUrl}/plugins/generic/reviewerCredits/images/logo-short.png" alt="ReviewerCredits Logo" style="height: 30px; margin-right: 10px;">
                        </button>
                        <button id="subscriptionBtn" class="pkp_button pkp_button_primary" style="margin-top: 20px; padding: 15px 30px; font-size: 1.2em; display: inline-flex; align-items: center;">
                            Subscription <img src="${baseImgUrl}/plugins/generic/reviewerCredits/images/logo-short.png" alt="ReviewerCredits Logo" style="height: 30px; margin-right: 10px;">
                        </button>
                    </div>
                `;
              $("#popupContainer .flex-container").html(errorMessage);
              showPopup();

              $("#contactSupportBtn").on("click", function () {
                window.open(
                  "https://www.reviewercredits.com/general-contact-us-page/",
                  "_blank"
                );
              });

              $("#subscriptionBtn").on("click", function () {
                window.open(
                  "https://www.reviewercredits.com/subscription-plans/",
                  "_blank"
                );
              });
            } else {
              $("#popupContainer .flex-container").html(
                "<p>No reviewer candidates available.</p>"
              );
              showPopup();
            }
          },
          error: function () {
            $(".pkp_loading").remove();
            $("#openPopupBtn").prop("disabled", false);
            $("#popupContainer .flex-container").html(
              "<p>Failed to fetch data.</p>"
            );
            showPopup();
          },
        });
      }
    }

    function displayReviewersData() {
      const reviewersHtml = generateReviewersHtml(reviewersData);
      $("#popupContainer section").html(reviewersHtml);
      bindSaveButtons();
      showPopup();
    }

    function generateReviewersHtml(reviewers) {
      return reviewers
        .map(
          (reviewer, index) => `
        <div class="box box1">
            <div class="content">
                <div class="level">${index + 1}</div>
                <div class="text">
                    <p class="name">${reviewer.name}</p>
                    <p class="job_title">${reviewer.email}</p>
                    <p class="job_discription">${reviewer.affiliation}</p>
                </div>
                <div class="row">
                    <div class="post"><p>Score</p><strong>${
                      reviewer.score
                    }</strong></div>
                    <div class="followers"><p>H-Index</p><strong>${
                      reviewer.hIndex
                    }</strong></div>
                    <div class="following"><p>Articles</p><strong>${
                      reviewer.articlesCount
                    }</strong></div>
                    <div class="following"><p>Citations</p><strong>${
                      reviewer.citationsCount
                    }</strong></div>
                </div>
                <div class="rc-finder-button">
                    <button class="orcid-button" type="button" ${
                      reviewer.orcid
                        ? `onclick="window.open('https://orcid.org/${reviewer.orcid}', '_blank');"`
                        : "disabled"
                    }>ORCID</button>
                    <button class="${
                      reviewer.registered ? "saved-button" : "save-button"
                    }" type="button" data-index="${index}" ${
            reviewer.registered ? "disabled" : ""
          }>${reviewer.registered ? "Saved" : "Save as a Reviewer"}</button>
                </div>
            </div>
        </div>
    `
        )
        .join("");
    }

    function bindSaveButtons() {
      $(".save-button").on("click", function () {
        var index = $(this).data("index");
        var reviewer = reviewersData[index];
        reviewer.index = index;
        saveReviewer(reviewer);
      });
    }

    function checkEnoughInfo(reviewer) {
      return reviewer.name && reviewer.email && reviewer.affiliation;
    }

    function saveReviewer(reviewer) {
      var index = reviewer.index;
      var buttonSelector = `button[data-index="${reviewer.index}"]`;
      var originalText = $(buttonSelector).text();

      $(buttonSelector)
        .html('Saving... <span class="pkp_spinner"></span>')
        .prop("disabled", true);

      $.ajax({
        url:
          baseUrl() +
          "$$$call$$$/grid/settings/plugins/settings-plugin-grid/manage",
        type: "POST",
        data: {
          verb: "addReviewerFromReviewerCredits",
          plugin: "reviewercreditsplugin",
          category: "generic",
          reviewerData: JSON.stringify(reviewer),
        },
        success: function (response) {
          if (response.content.success) {
            $(buttonSelector)
              .text("Saved")
              .removeClass("save-button")
              .addClass("saved-button")
              .prop("disabled", true);
            reviewersData[index].registered = 1;
          } else if (response.content.userExists) {
            $(buttonSelector).html(originalText).prop("disabled", false);
            alert(response.content.userExists);
          } else {
            $(buttonSelector).html(originalText).prop("disabled", false);
            alert("Failed to save reviewer.");
          }
        },
        error: function () {
          $(buttonSelector).html(originalText).prop("disabled", false);
          alert("Failed to connect to server.");
        },
      });
    }

    function showPopup() {
      $("#popupOverlay").show();
      $("#popupContainer").show();
      $("#popupOverlay")
        .off("click")
        .on("click", function (event) {
          if (!$(event.target).closest("#popupContainer").length) {
            closePopup();
          }
        });

      $("#popupContainer").click(function (event) {
        event.stopPropagation();
      });
    }

    function closePopup() {
      $("#popupOverlay").hide();
      $("#popupContainer").hide();
    }

    function setupReviewerFinder(target) {
      var reviewerFinderHtml = "";
      if (!$("li.pkp_workflow_submission").hasClass("ui-tabs-active")) {
      } else {
        if (target && !$(target).data("reviewerSetupDone")) {
          var reviewerFinderHtml = `
          <div>
  <div class="pkp_controllers_grid pkp_grid_category" style="margin-top: 20px;">
    <div class="header">
      <h4>Find Reviewer From ReviewerCredits</h4>
    </div>
    <table>
      <colgroup>
        <col class="grid-column column-participants" style="width: 98%;">
      </colgroup>
      <thead>
        <tr>
          <th scope="col" style="text-align: left;"></th>
        </tr>
      </thead>
      <tbody class="empty">
        <tr>
          <td colspan="1">
            <button type="button" id="openPopupBtn" class="pkp_button pkp_button_primary">
              Find Reviewer 
              <img src="${baseImgUrl}/plugins/generic/reviewerCredits/images/logo-short.png" alt="ReviewerCredits Logo" style="height: 32px; vertical-align: middle;">
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div id="popupOverlay" class="popupOverlay"></div>
  <div id="popupContainer" class="popupContainer">
    <h2 class="rc-finder-title">
      Reviewers List by 
      <img src="${baseImgUrl}/plugins/generic/reviewerCredits/images/logo-long.png" alt="ReviewerCredits Logo" style="height: 40px; vertical-align: middle;">
    </h2>
    <section class="flex-container">
      <p>Loading...</p>
    </section>
    <button id="closePopupBtn" class="pkp_button pkp_button_offset">Close</button>
  </div>
</div>
`;
          target.insertAdjacentHTML("afterend", reviewerFinderHtml);
          $("#openPopupBtn").on("click", openPopup);
          $("#closePopupBtn").on("click", closePopup);
          $(target).data("reviewerSetupDone", true);
        }
      }
    }
  });
</script>
{/literal}