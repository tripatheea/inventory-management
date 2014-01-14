// BEGIN LICENSE
// Copyright (C) 2011 Sajan Maharjan sajanm@live.com
// This program is free software: you can redistribute it and/or modify it 
// under the terms of the GNU General Public License version 3, as published 
// by the Free Software Foundation.
// 
// This program is distributed in the hope that it will be useful, but 
// WITHOUT ANY WARRANTY; without even the implied warranties of 
// MERCHANTABILITY, SATISFACTORY QUALITY, or FITNESS FOR A PARTICULAR 
// PURPOSE.  See the GNU General Public License for more details.
// 
// You should have received a copy of the GNU General Public License along 
// with this program.  If not, see <http://www.gnu.org/licenses/>.
////// END LICENSE	

function showCalendarBox(t){var e=$("#"+t).val()
$("#ndp-target-id").html(t)
var s=$("#"+t).position()
$("#ndp-nepali-box").css("top",s.top+$("#"+t).outerHeight()),$("#ndp-nepali-box").css("left",s.left),showCalendar(e)}

function setSelectedDay(t)
{
	var e=$("#ndp-target-id").html()
	$("#"+e).val(t),hideCalendarBox()
	// The following line has been custom-added. This function refreshes the data.
	refresh_data();
}

function showCalendar(t){$("#ndp-nepali-box table").find("tr:gt(0)").remove(),""==t?$("#ndp-nepali-box table").append(getDateTable("")):$("#ndp-nepali-box table").append(getDateTable(t)),"block"==$("#ndp-nepali-box").css("display")&&$("#ndp-nepali-box").hide(),$("#ndp-nepali-box").fadeIn(100)}function getDateTable(t){if(""==t){var e=getNepaliDate(),s=getMonthParameters(e),a=getDateRows(s[0],s[1],s[2],s[3],s[4])
return a}var s=getMonthParameters(t),a=getDateRows(s[0],s[1],s[2],s[3],s[4])
return a}function getMonthParameters(t){var e=t.split("-"),s=e[0],a=e[1]
$("#currentMonth").html(getNepaliMonth(a-1)+"&nbsp;"+englishNo2Nep(s)),nYear=pYear=s,nMonth=parseInt(a,10)+1,nMonth>12&&(nYear++,nMonth="01"),pMonth=parseInt(a,10)-1,1>pMonth&&(pYear--,pMonth="12"),$("#prev").attr("onclick","showCalendar('"+pYear+"-"+pMonth+"-"+"01')"),$("#next").attr("onclick","showCalendar('"+nYear+"-"+nMonth+"-"+"01')")
var n=e[2],r=numberOfBsDays(s,a-1),i=new NepaliDateConverter,h=a+"/"+"1"+"/"+s,d=i.bs2ad(h),o=d.split("-"),b=o[0],u=o[1],c=o[2],l=new Date(b,u-1,c),p=l.getDay()
return[p,r,s,a,n]}function getDateRows(t,e,s,a,n){var r=getNepaliDate(),i=r.split("-")
i[0]
for(var h=get2DigitNo(i[1]),d=get2DigitNo(i[2]),o="",b=0;t+e>b;b++){0==b%7&&(o+="<tr>")
var u=b-t+1,c=""+s+"-"+get2DigitNo(a)+"-"+get2DigitNo(u),l=""
l=get2DigitNo(a)==h&&d==get2DigitNo(u)?"ndp-selected":u==n?"ndp-current":"ndp-date",t>b?o+="<td></td>\n":(o+="<td class='"+l+"'>",o+="<a href='#' onclick=\"setSelectedDay('"+c+"')\">"+englishNo2Nep(u)+"</a>",o+="</td>\n"),6==b%7&&(o+="</tr>\n")}return o}function hideCalendarBox(){$("#ndp-nepali-box").fadeOut(100)}function get2DigitNo(t){return t=parseInt(t,10),10>t?"0"+(""+t):""+t}function getMonths(){var t=["January","February","March","April","May","June","July","August","September","October","November","December"]
return t}function getNepaliMonths(){var t=["Baisakh","Jestha","Ashar","Shrawan","Bhadra","Ashoj","Kartik","Mangsir","Poush","Magh","Falgun","Chaitra"]
return t}function getNepaliDaysShort(){var t=["आ","सो","मं","बु","बि","शु","श"]
return t}function getNepaliMonth(t){t=parseInt(t,10)
var e=["बैशाख","जेठ","अषाढ","श्रावण","भाद्र","आश्विन","कार्तिक","मङ्सिर","पौष","माघ","फाल्गुन","चैत्र"]
return e[t]}function getCurrentDayName(){var t=new Date,e=t.getDay(),s=Array(7)
return s[0]="Sunday",s[1]="Monday",s[2]="Tuesday",s[3]="Wednesday",s[4]="Thursday",s[5]="Friday",s[6]="Saturday",s[e]}function getDayFromDate(t){var e=t.split("-"),s=e[2],a=e[1],n=e[0],r=new Date(n,a-1,s),i=r.getDay(),h=["Sun","Mon","Tue","Wed","Thu","Fri","Sat"]
return h[i]}function numberOfBsDays(t,e){var s=new NepaliDateConverter
return s.bs[t][e]}function numberOfDays(t,e){var s=new Date(t,e,0)
return s.getDate()}function getNepaliDate(){var t=new NepaliDateConverter
return t.ad2bs(getDateInNo("/"))}function getDateInWords(){var t=getMonths(),e=new Date,s=e.getDate(),a=e.getMonth()+1,n=e.getYear(),r=1e3>n?n+1900:n
return s+" "+t[a]+", "+r}function getDateInNo(t){var e=new Date,s=e.getDate(),a=e.getMonth()+1,n=e.getFullYear()
return a+t+s+t+n}function getAdDateInWords(t){var e=getMonths(),s=t.split("-"),a=s[2],n=s[1],r=s[0]
return a+" "+e[n]+", "+r}function getNepaliDateInWords(t){var e=getNepaliMonths(),s=t.split("-"),a=s[2],n=s[1],r=s[0]
return a+" "+e[n]+", "+r}function getCurrentYear(){var t=new Date,e=t.getFullYear()
return e}function getCurrentMonth(){var t=new Date,e=t.getMonth()+1
return e}function getCurrentDay(){var t=new Date,e=t.getDate()
return e}function makeArray(){for(i=0;makeArray.arguments.length>i;i++)this[i+1]=makeArray.arguments[i]}function englishNo2Nep(t){t=""+t
for(var e="",s=0;t.length>s;s++)e+=convertNos(t[s])
return e}function convertNos(t){switch(t){case"०":return 0
case"१":return 1
case"२":return 2
case"३":return 3
case"४":return 4
case"५":return 5
case"६":return 6
case"७":return 7
case"८":return 8
case"९":return 9
case"0":return"०"
case"1":return"१"
case"2":return"२"
case"3":return"३"
case"4":return"४"
case"5":return"५"
case"6":return"६"
case"7":return"७"
case"8":return"८"
case"9":return"९"}}function NepaliDateConverter(){this.bs_date_eq="09/17/2000",this.ad_date_eq="01/01/1944",this.bs=[],this.bs[2e3]=[30,32,31,32,31,30,30,30,29,30,29,31],this.bs[2001]=[31,31,32,31,31,31,30,29,30,29,30,30],this.bs[2002]=[31,31,32,32,31,30,30,29,30,29,30,30],this.bs[2003]=[31,32,31,32,31,30,30,30,29,29,30,31],this.bs[2004]=[30,32,31,32,31,30,30,30,29,30,29,31],this.bs[2005]=[31,31,32,31,31,31,30,29,30,29,30,30],this.bs[2006]=[31,31,32,32,31,30,30,29,30,29,30,30],this.bs[2007]=[31,32,31,32,31,30,30,30,29,29,30,31],this.bs[2008]=[31,31,31,32,31,31,29,30,30,29,29,31],this.bs[2009]=[31,31,32,31,31,31,30,29,30,29,30,30],this.bs[2010]=[31,31,32,32,31,30,30,29,30,29,30,30],this.bs[2011]=[31,32,31,32,31,30,30,30,29,29,30,31],this.bs[2012]=[31,31,31,32,31,31,29,30,30,29,30,30],this.bs[2013]=[31,31,32,31,31,31,30,29,30,29,30,30],this.bs[2014]=[31,31,32,32,31,30,30,29,30,29,30,30],this.bs[2015]=[31,32,31,32,31,30,30,30,29,29,30,31],this.bs[2016]=[31,31,31,32,31,31,29,30,30,29,30,30],this.bs[2017]=[31,31,32,31,31,31,30,29,30,29,30,30],this.bs[2018]=[31,32,31,32,31,30,30,29,30,29,30,30],this.bs[2019]=[31,32,31,32,31,30,30,30,29,30,29,31],this.bs[2020]=[31,31,31,32,31,31,30,29,30,29,30,30],this.bs[2021]=[31,31,32,31,31,31,30,29,30,29,30,30],this.bs[2022]=[31,32,31,32,31,30,30,30,29,29,30,30],this.bs[2023]=[31,32,31,32,31,30,30,30,29,30,29,31],this.bs[2024]=[31,31,31,32,31,31,30,29,30,29,30,30],this.bs[2025]=[31,31,32,31,31,31,30,29,30,29,30,30],this.bs[2026]=[31,32,31,32,31,30,30,30,29,29,30,31],this.bs[2027]=[30,32,31,32,31,30,30,30,29,30,29,31],this.bs[2028]=[31,31,32,31,31,31,30,29,30,29,30,30],this.bs[2029]=[31,31,32,31,32,30,30,29,30,29,30,30],this.bs[2030]=[31,32,31,32,31,30,30,30,29,29,30,31],this.bs[2031]=[30,32,31,32,31,30,30,30,29,30,29,31],this.bs[2032]=[31,31,32,31,31,31,30,29,30,29,30,30],this.bs[2033]=[31,31,32,32,31,30,30,29,30,29,30,30],this.bs[2034]=[31,32,31,32,31,30,30,30,29,29,30,31],this.bs[2035]=[30,32,31,32,31,31,29,30,30,29,29,31],this.bs[2036]=[31,31,32,31,31,31,30,29,30,29,30,30],this.bs[2037]=[31,31,32,32,31,30,30,29,30,29,30,30],this.bs[2038]=[31,32,31,32,31,30,30,30,29,29,30,31],this.bs[2039]=[31,31,31,32,31,31,29,30,30,29,30,30],this.bs[2040]=[31,31,32,31,31,31,30,29,30,29,30,30],this.bs[2041]=[31,31,32,32,31,30,30,29,30,29,30,30],this.bs[2042]=[31,32,31,32,31,30,30,30,29,29,30,31],this.bs[2043]=[31,31,31,32,31,31,29,30,30,29,30,30],this.bs[2044]=[31,31,32,31,31,31,30,29,30,29,30,30],this.bs[2045]=[31,32,31,32,31,30,30,29,30,29,30,30],this.bs[2046]=[31,32,31,32,31,30,30,30,29,29,30,31],this.bs[2047]=[31,31,31,32,31,31,30,29,30,29,30,30],this.bs[2048]=[31,31,32,31,31,31,30,29,30,29,30,30],this.bs[2049]=[31,32,31,32,31,30,30,30,29,29,30,30],this.bs[2050]=[31,32,31,32,31,30,30,30,29,30,29,31],this.bs[2051]=[31,31,31,32,31,31,30,29,30,29,30,30],this.bs[2052]=[31,31,32,31,31,31,30,29,30,29,30,30],this.bs[2053]=[31,32,31,32,31,30,30,30,29,29,30,30],this.bs[2054]=[31,32,31,32,31,30,30,30,29,30,29,31],this.bs[2055]=[31,31,32,31,31,31,30,29,30,29,30,30],this.bs[2056]=[31,31,32,31,32,30,30,29,30,29,30,30],this.bs[2057]=[31,32,31,32,31,30,30,30,29,29,30,31],this.bs[2058]=[30,32,31,32,31,30,30,30,29,30,29,31],this.bs[2059]=[31,31,32,31,31,31,30,29,30,29,30,30],this.bs[2060]=[31,31,32,32,31,30,30,29,30,29,30,30],this.bs[2061]=[31,32,31,32,31,30,30,30,29,29,30,31],this.bs[2062]=[30,32,31,32,31,31,29,30,29,30,29,31],this.bs[2063]=[31,31,32,31,31,31,30,29,30,29,30,30],this.bs[2064]=[31,31,32,32,31,30,30,29,30,29,30,30],this.bs[2065]=[31,32,31,32,31,30,30,30,29,29,30,31],this.bs[2066]=[31,31,31,32,31,31,29,30,30,29,29,31],this.bs[2067]=[31,31,32,31,31,31,30,29,30,29,30,30],this.bs[2068]=[31,31,32,32,31,30,30,29,30,29,30,30],this.bs[2069]=[31,32,31,32,31,30,30,30,29,29,30,31],this.bs[2070]=[31,31,31,32,31,31,29,30,30,29,30,30],this.bs[2071]=[31,31,32,31,31,31,30,29,30,29,30,30],this.bs[2072]=[31,32,31,32,31,30,30,29,30,29,30,30],this.bs[2073]=[31,32,31,32,31,30,30,30,29,29,30,31],this.bs[2074]=[31,31,31,32,31,31,30,29,30,29,30,30],this.bs[2075]=[31,31,32,31,31,31,30,29,30,29,30,30],this.bs[2076]=[31,32,31,32,31,30,30,30,29,29,30,30],this.bs[2077]=[31,32,31,32,31,30,30,30,29,30,29,31],this.bs[2078]=[31,31,31,32,31,31,30,29,30,29,30,30],this.bs[2079]=[31,31,32,31,31,31,30,29,30,29,30,30],this.bs[2080]=[31,32,31,32,31,30,30,30,29,29,30,30],this.bs[2081]=[31,31,32,32,31,30,30,30,29,30,30,30],this.bs[2082]=[30,32,31,32,31,30,30,30,29,30,30,30],this.bs[2083]=[31,31,32,31,31,30,30,30,29,30,30,30],this.bs[2084]=[31,31,32,31,31,30,30,30,29,30,30,30],this.bs[2085]=[31,32,31,32,30,31,30,30,29,30,30,30],this.bs[2086]=[30,32,31,32,31,30,30,30,29,30,30,30],this.bs[2087]=[31,31,32,31,31,31,30,30,29,30,30,30],this.bs[2088]=[30,31,32,32,30,31,30,30,29,30,30,30],this.bs[2089]=[30,32,31,32,31,30,30,30,29,30,30,30],this.bs[2090]=[30,32,31,32,31,30,30,30,29,30,30,30],this.count_ad_days=count_ad_days,this.count_bs_days=count_bs_days,this.add_bs_days=add_bs_days,this.add_ad_days=add_ad_days,this.bs2ad=bs2ad,this.ad2bs=ad2bs}function count_ad_days(t,e){var s=864e5,a=t.split("/"),n=e.split("/")
a[2]=Number(a[2]),a[1]=Number(a[1]),a[0]=Number(a[0]),n[2]=Number(n[2]),n[1]=Number(n[1]),n[0]=Number(n[0])
var r=new Date(a[2],a[0]-1,a[1]),i=new Date(n[2],n[0]-1,n[1]),h=Math.ceil((i.getTime()-r.getTime())/s)
return h}function count_bs_days(t,e){var s=t.split("/"),a=e.split("/"),n=Number(s[2]),r=Number(s[0]),i=Number(s[1]),h=Number(a[2]),d=Number(a[0]),o=Number(a[1]),b=0,u=0
for(u=n;h>=u;u++)b+=arraySum(this.bs[u])
for(u=0;r>u;u++)b-=this.bs[n][u]
for(b+=this.bs[n][11],u=d-1;12>u;u++)b-=this.bs[h][u]
return b-=i+1,b+=o-1}function add_ad_days(t,e){var s=new Date(t)
return s.setDate(s.getDate()+e),s.getFullYear()+"-"+(s.getMonth()+1)+"-"+s.getDate()}function add_bs_days(t,e){var s=t.split("/"),a=Number(s[2]),n=Number(s[0]),r=Number(s[1])
for(r+=e;r>this.bs[a][n-1];)r-=this.bs[a][n-1],n++,n>12&&(n=1,a++)
return a+"-"+n+"-"+r}function bs2ad(t){return days_count=this.count_bs_days(this.bs_date_eq,t),this.add_ad_days(this.ad_date_eq,days_count)}function ad2bs(t){return days_count=this.count_ad_days(this.ad_date_eq,t),this.add_bs_days(this.bs_date_eq,days_count)}(function(t){t.fn.nepaliDatePicker=function(){this.each(function(){var e=t(this).attr("id")
t(this).addClass("ndp-nepali-calendar"),t(this).attr("onfocus","showCalendarBox('"+e+"')"),t("body").append(calendarDivString)}),t(".ndp-nepali-calendar, #ndp-nepali-box").hover(function(){mouse_is_inside=!0},function(){mouse_is_inside=!1}),t("html").mouseup(function(){mouse_is_inside||hideCalendarBox()})}})(jQuery)
var mouse_is_inside=!1,calendarDivString='<div id="ndp-nepali-box" class="ndp-corner-all" style="display:none">'
calendarDivString+='<span id="ndp-target-id" style="display:none"></span>',calendarDivString+='<div class="ndp-corner-all ndp-header">',calendarDivString+='<a href="javascript:void(0)" id="prev" title="Previous Month" class="ndp-prev"></a>',calendarDivString+='<a href="javascript:void(0)" id="next" title="Next Month" class="ndp-next"></a>',calendarDivString+='<span id="currentMonth"></span>',calendarDivString+="</div>",calendarDivString+="<table>",calendarDivString+='<tr class="ndp-days">',calendarDivString+="<th>आ</th>",calendarDivString+="<th>सो</th>",calendarDivString+="<th>मं</th>",calendarDivString+="<th>बु</th>",calendarDivString+="<th>बि</th>",calendarDivString+="<th>शु</th>",calendarDivString+="<th>श</th>",calendarDivString+="</tr>",calendarDivString+="</table>",calendarDivString+="</div>",arraySum=function(t){for(var e=0,s=t.length;s;e+=t[--s]);return e}
