// Code goes here

$(document).ready(function(){
    
    $(".grid thead td").click(function(){
      showFilterOption(this);
    });
    
});

var arrayMap = {};

function showFilterOption(tdObject){
  var filterGrid = $(tdObject).find(".filter");
  
  if (filterGrid.is(":visible")){
    filterGrid.hide();
    return;
  }
  
  $(".filter").hide();
  
  var index = 0;
  filterGrid.empty();
  var allSelected = true;
  filterGrid.append('<div><input id="all" type="checkbox" checked>Select All</div>');
  
  var $rows = $(tdObject).parents("table").find("tbody tr");
  
  
  $rows.each(function(ind, ele){
    var currentTd = $(ele).children()[$(tdObject).attr("index")];
    var div = document.createElement("div");
    div.classList.add("grid-item")
    var str = $(ele).is(":visible") ? 'checked' : '';
    if ($(ele).is(":hidden")){
      allSelected = false;
    }
    div.innerHTML = '<input type="checkbox" '+str+' >'+currentTd.innerHTML;
    filterGrid.append(div);
    arrayMap[index] = ele;
    index++;
  });
  
  if (!allSelected){
    filterGrid.find("#all").removeAttr("checked");
  }
  
  filterGrid.append('<div><input id="close" type="button" value="Close"/><input id="ok" type="button" value="Ok"/></div>');
  filterGrid.show();
  
  var $closeBtn = filterGrid.find("#close");
  var $okBtn = filterGrid.find("#ok");
  var $checkElems = filterGrid.find("input[type='checkbox']");
  var $gridItems = filterGrid.find(".grid-item");
  var $all = filterGrid.find("#all");
  
  $closeBtn.click(function(){
    filterGrid.hide();
    return false;
  });
  
  $okBtn.click(function(){
    filterGrid.find(".grid-item").each(function(ind,ele){
      if ($(ele).find("input").is(":checked")){
        $(arrayMap[ind]).show();
      }else{
        $(arrayMap[ind]).hide();
      }
    });
    filterGrid.hide();
    return false;
  });
  
  $checkElems.click(function(event){
    event.stopPropagation();
  });
  
  $gridItems.click(function(event){
    var chk = $(this).find("input[type='checkbox']");
    $(chk).prop("checked",!$(chk).is(":checked"));
  });
  
  $all.change(function(){
    var chked = $(this).is(":checked");
    filterGrid.find(".grid-item [type='checkbox']").prop("checked",chked);
  })
  
  filterGrid.click(function(event){
    event.stopPropagation();
  });
  
  return filterGrid;
}