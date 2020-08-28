var currentlyHovered = null;
var currentHoverBox = null;
var old = null;
var timeout = false;

function isHover(e) {
    return (e.parentElement.querySelector(':hover') === e);
}


var spans = document.getElementsByClassName("span");
document.onmousemove = function(e){
    if(currentlyHovered != null && currentHoverBox != null) {
        var finalX = e.clientX + 10;
        var finalY = e.clientY + 5;
        currentHoverBox.style.left = finalX + "px";
        currentHoverBox.style.top = finalY + "px";
        
    }
    for(var i = 0; i < spans.length; i+=1) {
        var mySpan = spans[i];
        if(isHover(mySpan) && (currentlyHovered == null || currentlyHovered.id != mySpan.id)) {
            currentlyHovered = mySpan;
            currentHoverBox = document.getElementById("hover" + mySpan.id.replace("span", ""));
            currentHoverBox.style.display = "block";
            currentHoverBox.style.animationName = "hover-in";
            currentHoverBox.style.animationDuration = "250ms";
            currentHoverBox.style.animationFillMode = "forwards";
            var finalX = e.clientX + 10;
            var finalY = e.clientY + 5;
            currentHoverBox.style.left = finalX + "px";
            currentHoverBox.style.top = finalY + "px";
        } else if(currentlyHovered != null && currentHoverBox != null && !isHover(mySpan) && currentlyHovered.id == mySpan.id) {
            currentHoverBox.style.animationName = "hover-out";
            currentHoverBox.style.animationDuration = "250ms";
            currentHoverBox.style.animationFillMode = "forwards";
            old = currentHoverBox;
            currentHoverBox = null;
            currentlyHovered = null;
            timeout = true;
            setTimeout(function(){
                old.style.display = "none";
                timeout = false;
            }, 250); 
            
        } else {
            if(currentHoverBox == null && old != null && !timeout) {
                old.style.display = "none";
            }
        }
        
    }
}