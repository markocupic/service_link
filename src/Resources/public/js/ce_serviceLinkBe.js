window.addEvent("domready", function(event) {
    if($$("#ctrl_faIcon #iconBox .checked").length){
        // Scroll to selected icon
        var myFx = new Fx.Scroll(document.id("iconBox")).toElement($$("#ctrl_faIcon #iconBox .checked")[0]);
    }
    $$("#iconBox input").addEvent("click", function(event){
        $$("#ctrl_faIcon #iconBox .checked").removeClass("checked");
        this.getParent("div").addClass("checked");
    });

    // Add event to filter input
    $$("input#faClassFilter").addEvent("input", function(event){
        var strFilter = this.getProperty("value").trim(" ");
        var itemCollection = $$(".font-awesome-icon-item");
        itemCollection.each(function(el){
            el.setStyle("display","inherit");
            if(strFilter != "")
            {
                if(el.getProperty("data-faClass").contains(strFilter) === false)
                {
                    el.setStyle("display","none");
                }
            }
        });
    });
});