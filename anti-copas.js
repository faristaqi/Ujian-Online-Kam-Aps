!function(){
    "use strict";
    window.addEventListener("contextmenu",(e=>{e.preventDefault()})),
    window.addEventListener("keydown",(e=>{e.ctrlKey&&e.preventDefault(),
                                            e.altKey&&e.preventDefault(),
                                            e.metaKey&&e.preventDefault(),
                                            e.shiftKey&&e.preventDefault(),
                                            e.repeat&&e.preventDefault()})),
    window.addEventListener("dblclick",(()=>{document.querySelector("body").setAttribute("style","user-select: none;")})),
    window.addEventListener("click",(()=>{document.querySelector("body").setAttribute("style","user-select: none;")}))
}();