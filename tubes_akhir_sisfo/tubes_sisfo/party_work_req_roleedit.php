<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
$EW_RELATIVE_PATH = "";
?>
<?php include_once $EW_RELATIVE_PATH . "ewcfg11.php" ?>
<?php include_once $EW_RELATIVE_PATH . "ewmysql11.php" ?>
<?php include_once $EW_RELATIVE_PATH . "phpfn11.php" ?>
<?php include_once $EW_RELATIVE_PATH . "party_work_req_roleinfo.php" ?>
<?php include_once $EW_RELATIVE_PATH . "userinfo.php" ?>
<?php include_once $EW_RELATIVE_PATH . "userfn11.php" ?>
<?php

//
// Page class
//

$party_work_req_role_edit = NULL; // Initialize page object first

class cparty_work_req_role_edit extends cparty_work_req_role {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = "{1F84AD9A-35E5-45ED-842B-365EF8643C81}";

	// Table name
	var $TableName = 'party_work_req_role';

	// Page object name
	var $PageObjName = 'party_work_req_role_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		if ($this->UseTokenInUrl) $PageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	function getWarningMessage() {
		return @$_SESSION[EW_SESSION_WARNING_MESSAGE];
	}

	function setWarningMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_WARNING_MESSAGE], $v);
	}

	// Show message
	function ShowMessage() {
		$hidden = FALSE;
		$html = "";

		// Message
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sMessage;
			$html .= "<div class=\"alert alert-info ewInfo\">" . $sMessage . "</div>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$sWarningMessage = $this->getWarningMessage();
		$this->Message_Showing($sWarningMessage, "warning");
		if ($sWarningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sWarningMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sWarningMessage;
			$html .= "<div class=\"alert alert-warning ewWarning\">" . $sWarningMessage . "</div>";
			$_SESSION[EW_SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sSuccessMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sSuccessMessage;
			$html .= "<div class=\"alert alert-success ewSuccess\">" . $sSuccessMessage . "</div>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sErrorMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sErrorMessage;
			$html .= "<div class=\"alert alert-danger ewError\">" . $sErrorMessage . "</div>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo "<div class=\"ewMessageDialog\"" . (($hidden) ? " style=\"display: none;\"" : "") . ">" . $html . "</div>";
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p>" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Footer exists, display
			echo "<p>" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm;
		if ($this->UseTokenInUrl) {
			if ($objForm)
				return ($this->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($this->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}
	var $Token = "";
	var $CheckToken = EW_CHECK_TOKEN;
	var $CheckTokenFn = "ew_CheckToken";
	var $CreateTokenFn = "ew_CreateToken";

	// Valid Post
	function ValidPost() {
		if (!$this->CheckToken || !ew_IsHttpPost())
			return TRUE;
		if (!isset($_POST[EW_TOKEN_NAME]))
			return FALSE;
		$fn = $this->CheckTokenFn;
		if (is_callable($fn))
			return $fn($_POST[EW_TOKEN_NAME]);
		return FALSE;
	}

	// Create Token
	function CreateToken() {
		global $gsToken;
		if ($this->CheckToken) {
			$fn = $this->CreateTokenFn;
			if ($this->Token == "" && is_callable($fn)) // Create token
				$this->Token = $fn();
			$gsToken = $this->Token; // Save to global variable
		}
	}

	//
	// Page class constructor
	//
	function __construct() {
		global $conn, $Language;
		$GLOBALS["Page"] = &$this;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Parent constuctor
		parent::__construct();

		// Table object (party_work_req_role)
		if (!isset($GLOBALS["party_work_req_role"]) || get_class($GLOBALS["party_work_req_role"]) == "cparty_work_req_role") {
			$GLOBALS["party_work_req_role"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["party_work_req_role"];
		}

		// Table object (user)
		if (!isset($GLOBALS['user'])) $GLOBALS['user'] = new cuser();

		// User table object (user)
		if (!isset($GLOBALS["UserTable"])) $GLOBALS["UserTable"] = new cuser();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'party_work_req_role', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate(ew_GetUrl("login.php"));
		}
		$Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		$Security->TablePermission_Loaded();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate(ew_GetUrl("login.php"));
		}
		if (!$Security->CanEdit()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage($Language->Phrase("NoPermission")); // Set no permission
			$this->Page_Terminate(ew_GetUrl("party_work_req_rolelist.php"));
		}

		// Create form object
		$objForm = new cFormObj();
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->ValidPost()) {
			echo $Language->Phrase("InvalidPostRequest");
			$this->Page_Terminate();
			exit();
		}

		// Process auto fill
		if (@$_POST["ajax"] == "autofill") {
			$results = $this->GetAutoFill(@$_POST["name"], @$_POST["q"]);
			if ($results) {

				// Clean output buffer
				if (!EW_DEBUG_ENABLED && ob_get_length())
					ob_end_clean();
				echo $results;
				$this->Page_Terminate();
				exit();
			}
		}

		// Create Token
		$this->CreateToken();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn, $gsExportFile, $gTmpImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EW_EXPORT, $party_work_req_role;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($party_work_req_role);
				$doc->Text = $sContent;
				if ($this->Export == "email")
					echo $this->ExportEmail($doc->Text);
				else
					$doc->Export();
				ew_DeleteTmpImages(); // Delete temp images
				exit();
			}
		}
		$this->Page_Redirecting($url);

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}
	var $DbMasterFilter;
	var $DbDetailFilter;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError;

		// Load key from QueryString
		if (@$_GET["pwrr_id"] <> "") {
			$this->pwrr_id->setQueryStringValue($_GET["pwrr_id"]);
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Process form if post back
		if (@$_POST["a_edit"] <> "") {
			$this->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values
		} else {
			$this->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($this->pwrr_id->CurrentValue == "")
			$this->Page_Terminate("party_work_req_rolelist.php"); // Invalid key, return to list

		// Validate form if post back
		if (@$_POST["a_edit"] <> "") {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		}
		switch ($this->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					if ($this->getFailureMessage() == "") $this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("party_work_req_rolelist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $this->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$this->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$this->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$this->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->pwrr_id->FldIsDetailKey) {
			$this->pwrr_id->setFormValue($objForm->GetValue("x_pwrr_id"));
		}
		if (!$this->fk_pwrr->FldIsDetailKey) {
			$this->fk_pwrr->setFormValue($objForm->GetValue("x_fk_pwrr"));
		}
		if (!$this->fk_pwrr2->FldIsDetailKey) {
			$this->fk_pwrr2->setFormValue($objForm->GetValue("x_fk_pwrr2"));
		}
		if (!$this->fk_pwrr3->FldIsDetailKey) {
			$this->fk_pwrr3->setFormValue($objForm->GetValue("x_fk_pwrr3"));
		}
		if (!$this->from_date->FldIsDetailKey) {
			$this->from_date->setFormValue($objForm->GetValue("x_from_date"));
		}
		if (!$this->thru_date->FldIsDetailKey) {
			$this->thru_date->setFormValue($objForm->GetValue("x_thru_date"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadRow();
		$this->pwrr_id->CurrentValue = $this->pwrr_id->FormValue;
		$this->fk_pwrr->CurrentValue = $this->fk_pwrr->FormValue;
		$this->fk_pwrr2->CurrentValue = $this->fk_pwrr2->FormValue;
		$this->fk_pwrr3->CurrentValue = $this->fk_pwrr3->FormValue;
		$this->from_date->CurrentValue = $this->from_date->FormValue;
		$this->thru_date->CurrentValue = $this->thru_date->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $Language;
		$sFilter = $this->KeyFilter();

		// Call Row Selecting event
		$this->Row_Selecting($sFilter);

		// Load SQL based on filter
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row = &$rs->fields;
		$this->Row_Selected($row);
		$this->pwrr_id->setDbValue($rs->fields('pwrr_id'));
		$this->fk_pwrr->setDbValue($rs->fields('fk_pwrr'));
		$this->fk_pwrr2->setDbValue($rs->fields('fk_pwrr2'));
		$this->fk_pwrr3->setDbValue($rs->fields('fk_pwrr3'));
		$this->from_date->setDbValue($rs->fields('from_date'));
		$this->thru_date->setDbValue($rs->fields('thru_date'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->pwrr_id->DbValue = $row['pwrr_id'];
		$this->fk_pwrr->DbValue = $row['fk_pwrr'];
		$this->fk_pwrr2->DbValue = $row['fk_pwrr2'];
		$this->fk_pwrr3->DbValue = $row['fk_pwrr3'];
		$this->from_date->DbValue = $row['from_date'];
		$this->thru_date->DbValue = $row['thru_date'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language;
		global $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// pwrr_id
		// fk_pwrr
		// fk_pwrr2
		// fk_pwrr3
		// from_date
		// thru_date

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

			// pwrr_id
			$this->pwrr_id->ViewValue = $this->pwrr_id->CurrentValue;
			$this->pwrr_id->ViewCustomAttributes = "";

			// fk_pwrr
			$this->fk_pwrr->ViewValue = $this->fk_pwrr->CurrentValue;
			$this->fk_pwrr->ViewCustomAttributes = "";

			// fk_pwrr2
			$this->fk_pwrr2->ViewValue = $this->fk_pwrr2->CurrentValue;
			$this->fk_pwrr2->ViewCustomAttributes = "";

			// fk_pwrr3
			$this->fk_pwrr3->ViewValue = $this->fk_pwrr3->CurrentValue;
			$this->fk_pwrr3->ViewCustomAttributes = "";

			// from_date
			$this->from_date->ViewValue = $this->from_date->CurrentValue;
			$this->from_date->ViewCustomAttributes = "";

			// thru_date
			$this->thru_date->ViewValue = $this->thru_date->CurrentValue;
			$this->thru_date->ViewCustomAttributes = "";

			// pwrr_id
			$this->pwrr_id->LinkCustomAttributes = "";
			$this->pwrr_id->HrefValue = "";
			$this->pwrr_id->TooltipValue = "";

			// fk_pwrr
			$this->fk_pwrr->LinkCustomAttributes = "";
			$this->fk_pwrr->HrefValue = "";
			$this->fk_pwrr->TooltipValue = "";

			// fk_pwrr2
			$this->fk_pwrr2->LinkCustomAttributes = "";
			$this->fk_pwrr2->HrefValue = "";
			$this->fk_pwrr2->TooltipValue = "";

			// fk_pwrr3
			$this->fk_pwrr3->LinkCustomAttributes = "";
			$this->fk_pwrr3->HrefValue = "";
			$this->fk_pwrr3->TooltipValue = "";

			// from_date
			$this->from_date->LinkCustomAttributes = "";
			$this->from_date->HrefValue = "";
			$this->from_date->TooltipValue = "";

			// thru_date
			$this->thru_date->LinkCustomAttributes = "";
			$this->thru_date->HrefValue = "";
			$this->thru_date->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// pwrr_id
			$this->pwrr_id->EditAttrs["class"] = "form-control";
			$this->pwrr_id->EditCustomAttributes = "";
			$this->pwrr_id->EditValue = $this->pwrr_id->CurrentValue;
			$this->pwrr_id->ViewCustomAttributes = "";

			// fk_pwrr
			$this->fk_pwrr->EditAttrs["class"] = "form-control";
			$this->fk_pwrr->EditCustomAttributes = "";
			$this->fk_pwrr->EditValue = ew_HtmlEncode($this->fk_pwrr->CurrentValue);
			$this->fk_pwrr->PlaceHolder = ew_RemoveHtml($this->fk_pwrr->FldCaption());

			// fk_pwrr2
			$this->fk_pwrr2->EditAttrs["class"] = "form-control";
			$this->fk_pwrr2->EditCustomAttributes = "";
			$this->fk_pwrr2->EditValue = ew_HtmlEncode($this->fk_pwrr2->CurrentValue);
			$this->fk_pwrr2->PlaceHolder = ew_RemoveHtml($this->fk_pwrr2->FldCaption());

			// fk_pwrr3
			$this->fk_pwrr3->EditAttrs["class"] = "form-control";
			$this->fk_pwrr3->EditCustomAttributes = "";
			$this->fk_pwrr3->EditValue = ew_HtmlEncode($this->fk_pwrr3->CurrentValue);
			$this->fk_pwrr3->PlaceHolder = ew_RemoveHtml($this->fk_pwrr3->FldCaption());

			// from_date
			$this->from_date->EditAttrs["class"] = "form-control";
			$this->from_date->EditCustomAttributes = "";
			$this->from_date->EditValue = ew_HtmlEncode($this->from_date->CurrentValue);
			$this->from_date->PlaceHolder = ew_RemoveHtml($this->from_date->FldCaption());

			// thru_date
			$this->thru_date->EditAttrs["class"] = "form-control";
			$this->thru_date->EditCustomAttributes = "";
			$this->thru_date->EditValue = ew_HtmlEncode($this->thru_date->CurrentValue);
			$this->thru_date->PlaceHolder = ew_RemoveHtml($this->thru_date->FldCaption());

			// Edit refer script
			// pwrr_id

			$this->pwrr_id->HrefValue = "";

			// fk_pwrr
			$this->fk_pwrr->HrefValue = "";

			// fk_pwrr2
			$this->fk_pwrr2->HrefValue = "";

			// fk_pwrr3
			$this->fk_pwrr3->HrefValue = "";

			// from_date
			$this->from_date->HrefValue = "";

			// thru_date
			$this->thru_date->HrefValue = "";
		}
		if ($this->RowType == EW_ROWTYPE_ADD ||
			$this->RowType == EW_ROWTYPE_EDIT ||
			$this->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$this->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!$this->pwrr_id->FldIsDetailKey && !is_null($this->pwrr_id->FormValue) && $this->pwrr_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->pwrr_id->FldCaption(), $this->pwrr_id->ReqErrMsg));
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language;
		$sFilter = $this->KeyFilter();
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->LoadDbValues($rsold);
			$rsnew = array();

			// pwrr_id
			// fk_pwrr

			$this->fk_pwrr->SetDbValueDef($rsnew, $this->fk_pwrr->CurrentValue, NULL, $this->fk_pwrr->ReadOnly);

			// fk_pwrr2
			$this->fk_pwrr2->SetDbValueDef($rsnew, $this->fk_pwrr2->CurrentValue, NULL, $this->fk_pwrr2->ReadOnly);

			// fk_pwrr3
			$this->fk_pwrr3->SetDbValueDef($rsnew, $this->fk_pwrr3->CurrentValue, NULL, $this->fk_pwrr3->ReadOnly);

			// from_date
			$this->from_date->SetDbValueDef($rsnew, $this->from_date->CurrentValue, NULL, $this->from_date->ReadOnly);

			// thru_date
			$this->thru_date->SetDbValueDef($rsnew, $this->thru_date->CurrentValue, NULL, $this->thru_date->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $this->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $this->Update($rsnew, "", $rsold);
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
				if ($EditRow) {
				}
			} else {
				if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage <> "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$Breadcrumb->Add("list", $this->TableVar, "party_work_req_rolelist.php", "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, ew_CurrentUrl());
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($party_work_req_role_edit)) $party_work_req_role_edit = new cparty_work_req_role_edit();

// Page init
$party_work_req_role_edit->Page_Init();

// Page main
$party_work_req_role_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$party_work_req_role_edit->Page_Render();
?>
<?php include_once $EW_RELATIVE_PATH . "header.php" ?>
<script type="text/javascript">

// Page object
var party_work_req_role_edit = new ew_Page("party_work_req_role_edit");
party_work_req_role_edit.PageID = "edit"; // Page ID
var EW_PAGE_ID = party_work_req_role_edit.PageID; // For backward compatibility

// Form object
var fparty_work_req_roleedit = new ew_Form("fparty_work_req_roleedit");

// Validate form
fparty_work_req_roleedit.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	this.PostAutoSuggest();
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
			elm = this.GetElements("x" + infix + "_pwrr_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $party_work_req_role->pwrr_id->FldCaption(), $party_work_req_role->pwrr_id->ReqErrMsg)) ?>");

			// Set up row object
			ew_ElementsToRow(fobj);

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ewForms[val])
			if (!ewForms[val].Validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
fparty_work_req_roleedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fparty_work_req_roleedit.ValidateRequired = true;
<?php } else { ?>
fparty_work_req_roleedit.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php $party_work_req_role_edit->ShowPageHeader(); ?>
<?php
$party_work_req_role_edit->ShowMessage();
?>
<form name="fparty_work_req_roleedit" id="fparty_work_req_roleedit" class="form-horizontal ewForm ewEditForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($party_work_req_role_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $party_work_req_role_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="party_work_req_role">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<div>
<?php if ($party_work_req_role->pwrr_id->Visible) { // pwrr_id ?>
	<div id="r_pwrr_id" class="form-group">
		<label id="elh_party_work_req_role_pwrr_id" for="x_pwrr_id" class="col-sm-2 control-label ewLabel"><?php echo $party_work_req_role->pwrr_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $party_work_req_role->pwrr_id->CellAttributes() ?>>
<span id="el_party_work_req_role_pwrr_id">
<span<?php echo $party_work_req_role->pwrr_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $party_work_req_role->pwrr_id->EditValue ?></p></span>
</span>
<input type="hidden" data-field="x_pwrr_id" name="x_pwrr_id" id="x_pwrr_id" value="<?php echo ew_HtmlEncode($party_work_req_role->pwrr_id->CurrentValue) ?>">
<?php echo $party_work_req_role->pwrr_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($party_work_req_role->fk_pwrr->Visible) { // fk_pwrr ?>
	<div id="r_fk_pwrr" class="form-group">
		<label id="elh_party_work_req_role_fk_pwrr" for="x_fk_pwrr" class="col-sm-2 control-label ewLabel"><?php echo $party_work_req_role->fk_pwrr->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $party_work_req_role->fk_pwrr->CellAttributes() ?>>
<span id="el_party_work_req_role_fk_pwrr">
<input type="text" data-field="x_fk_pwrr" name="x_fk_pwrr" id="x_fk_pwrr" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($party_work_req_role->fk_pwrr->PlaceHolder) ?>" value="<?php echo $party_work_req_role->fk_pwrr->EditValue ?>"<?php echo $party_work_req_role->fk_pwrr->EditAttributes() ?>>
</span>
<?php echo $party_work_req_role->fk_pwrr->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($party_work_req_role->fk_pwrr2->Visible) { // fk_pwrr2 ?>
	<div id="r_fk_pwrr2" class="form-group">
		<label id="elh_party_work_req_role_fk_pwrr2" for="x_fk_pwrr2" class="col-sm-2 control-label ewLabel"><?php echo $party_work_req_role->fk_pwrr2->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $party_work_req_role->fk_pwrr2->CellAttributes() ?>>
<span id="el_party_work_req_role_fk_pwrr2">
<input type="text" data-field="x_fk_pwrr2" name="x_fk_pwrr2" id="x_fk_pwrr2" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($party_work_req_role->fk_pwrr2->PlaceHolder) ?>" value="<?php echo $party_work_req_role->fk_pwrr2->EditValue ?>"<?php echo $party_work_req_role->fk_pwrr2->EditAttributes() ?>>
</span>
<?php echo $party_work_req_role->fk_pwrr2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($party_work_req_role->fk_pwrr3->Visible) { // fk_pwrr3 ?>
	<div id="r_fk_pwrr3" class="form-group">
		<label id="elh_party_work_req_role_fk_pwrr3" for="x_fk_pwrr3" class="col-sm-2 control-label ewLabel"><?php echo $party_work_req_role->fk_pwrr3->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $party_work_req_role->fk_pwrr3->CellAttributes() ?>>
<span id="el_party_work_req_role_fk_pwrr3">
<input type="text" data-field="x_fk_pwrr3" name="x_fk_pwrr3" id="x_fk_pwrr3" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($party_work_req_role->fk_pwrr3->PlaceHolder) ?>" value="<?php echo $party_work_req_role->fk_pwrr3->EditValue ?>"<?php echo $party_work_req_role->fk_pwrr3->EditAttributes() ?>>
</span>
<?php echo $party_work_req_role->fk_pwrr3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($party_work_req_role->from_date->Visible) { // from_date ?>
	<div id="r_from_date" class="form-group">
		<label id="elh_party_work_req_role_from_date" for="x_from_date" class="col-sm-2 control-label ewLabel"><?php echo $party_work_req_role->from_date->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $party_work_req_role->from_date->CellAttributes() ?>>
<span id="el_party_work_req_role_from_date">
<input type="text" data-field="x_from_date" name="x_from_date" id="x_from_date" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($party_work_req_role->from_date->PlaceHolder) ?>" value="<?php echo $party_work_req_role->from_date->EditValue ?>"<?php echo $party_work_req_role->from_date->EditAttributes() ?>>
</span>
<?php echo $party_work_req_role->from_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($party_work_req_role->thru_date->Visible) { // thru_date ?>
	<div id="r_thru_date" class="form-group">
		<label id="elh_party_work_req_role_thru_date" for="x_thru_date" class="col-sm-2 control-label ewLabel"><?php echo $party_work_req_role->thru_date->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $party_work_req_role->thru_date->CellAttributes() ?>>
<span id="el_party_work_req_role_thru_date">
<input type="text" data-field="x_thru_date" name="x_thru_date" id="x_thru_date" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($party_work_req_role->thru_date->PlaceHolder) ?>" value="<?php echo $party_work_req_role->thru_date->EditValue ?>"<?php echo $party_work_req_role->thru_date->EditAttributes() ?>>
</span>
<?php echo $party_work_req_role->thru_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
	</div>
</div>
</form>
<script type="text/javascript">
fparty_work_req_roleedit.Init();
</script>
<?php
$party_work_req_role_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once $EW_RELATIVE_PATH . "footer.php" ?>
<?php
$party_work_req_role_edit->Page_Terminate();
?>
