/* TableReservation, (c)2017 Dennis Sagasser, LGPL license */
window.addEvent("domready",function(){$$("div.toggleInputDiv").addEvent("click",function(){this.toggleClass("active");if(this.hasClass("active")===true){this.getAllNext("input").set("class","filledInput");this.getAllNext("input").removeProperty("disabled")}if(this.hasClass("active")===false){this.getAllNext("input").set("class","emptyInput");this.getAllNext("input").setProperty("disabled",true)}})})

