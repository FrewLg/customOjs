{**
	* plugins/generic/reviewerCredits/confirmRCEditF3.tpl
	*
	* Copyright (c) 2015-2018 University of Pittsburgh
	* Copyright (c) 2014-2018 Simon Fraser University
	* Copyright (c) 2003-2018 John Willinsky
	* Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
	*
	* Edit ReviewerCredits data
	*
*}
<script type="text/javascript">
	function updateF3(cb) {
    	if (cb.checked) {
			// document.getElementById("confirmF3").checked = true
		} else {
			// document.getElementById("confirmF3").checked = false
		}
    }
</script>

<style type=text/css>
	.checkbox_class {
		width: 17px;
		height: 17px;
	}
</style>
<div class="section">
    <span class="label">{translate key="plugins.generic.reviewerCredits.form.label"}</span>
    <label class="description">{translate key="plugins.generic.reviewerCredits.form.label.description"
        linkOpen="<a href=\"https://www.reviewercredits.com\" target=\"_blank\">"
        linkClose="</a>"
        linkSignUpOpen="<a href=\"https://www.reviewercredits.com\\reviewer-signup\" target=\"_blank\">"
        linkSignUpClose="</a>"
        }</label>
    <ul class="checkbox_and_radiobutton">
        <li>
            <label style="min-height: 30px;">
                <input type="checkbox" id="confirmSendRC" onclick='updateF3(this);' value="1" name="confirmSendRC"
                       class="field checkbox checkbox_class" aria-required="true">
                {translate key="plugins.generic.reviewerCredits.form.consent"}
            </label>
        </li>
        <li>
            <label >
                <input type="checkbox" id="confirmF3" value="1" name="confirmF3" class="field checkbox checkbox_class"
                       aria-required="true">
                {translate
				linkF3Index="<a href=\"https://www.reviewercredits.com\\reviewer-contribution-f3-index\" target=\"_blank\">"
				linkClose="</a>"
				key="plugins.generic.reviewerCredits.form.consentF3"}
            </label>
        </li>
    </ul>
</div>
