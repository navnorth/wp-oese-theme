function oesePreviewDraftCopyToClipboard(element) {
  var copyText = document.getElementById("oese-preview-url-input");
  copyText.select(); 
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/
  document.execCommand("copy");
  alert("Copied Preview URL: " + copyText.value);
}