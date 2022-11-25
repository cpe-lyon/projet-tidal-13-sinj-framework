function openDocs(evt, docName) {
    let i, tabContent, tabButton;

    tabContent = document.getElementsByClassName("docs");
    for (i = 0; i < tabContent.length; i++) {
        tabContent[i].style.display = "none";
    }

    tabButton = document.getElementsByClassName("doc-button");
    for (i = 0; i < tabButton.length; i++) {
        tabButton[i].className = tabButton[i].className.replace(" active", "");
    }

    document.getElementById(docName).style.display = "block";
    evt.currentTarget.className += " active";
}