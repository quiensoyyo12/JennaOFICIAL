const allLinks = document.querySelectorAll (".tabs a");
const allTabs = document. querySelectorAll(".tab-content");

allLinks.forEach((elem) =>{
    elem.addEventListener("click", function(){
        const linkId = elem.id;
        const hrefLinkClick =elem.href;

        allLinks .forEach((link) => {
            if(link.href == hrefLinkClick){
                link.classList.add("active");
            }else{
                link.classList.remove("active");
            }
        });
        allTabs.forEach((tab) =>{
            if(tab.id.includes(linkId)){
                tab.classList.add("tab-content--active");
                genereteTabItems(elemlocation.reload());
            }else{
                tab.classList.remove("tab-content--active");
            }
        });
    });
});