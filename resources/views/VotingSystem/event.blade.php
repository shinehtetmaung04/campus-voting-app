<!DOCTYPE html>
<html lang="my">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CU Thaton Ceremony Program</title>

<style>
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Myanmar:wght@400;600;700&display=swap');

/* Reset & Base */
*{
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body{
    font-family: 'Noto Sans Myanmar', sans-serif;
    background: linear-gradient(135deg,#eef2ff,#f8fafc);
    color: #1f2933;
    line-height: 1.7;
}

/* Page Wrapper */
.page{
    display: flex;
    justify-content: center;
    padding: 50px 5px 50px;
}

/* Poster Card */
.poster{
    background: #ffffff;
    padding: 10px;
    border-radius: 20px;
    box-shadow: 0 20px 45px rgba(0,0,0,0.15);
}

/* Back Button */
.back-btn{
    position: fixed;
    top: 9px;
    left: 9px;
    width: 10%;
    background: #2563eb;
    color: #fff;
    padding: 2px;
    border: none;
    border-radius: 12px;
    font-size: 25px;
    cursor: pointer;
    box-shadow: 0 6px 18px rgba(0,0,0,0.25);
    transition: all 0.3s ease;
    z-index: 100;
}
.back-btn:hover{
    background: #1e40af;
    transform: translateY(-2px);
}

/* Header */
.header{
    text-align: center;
    margin-bottom: 30px;
}
.header h2{
    font-size: 20px;
    font-weight: 700;
    color: #1e40af;
    margin-bottom: 10px;
}
.header h4{
    font-size: 16px;
    font-weight: 600;
    color: #374151;
    line-height: 2.0;
}

/* Section */
.section{
    margin-top: 30px;
}
.section-title{
    font-size: 16px;
    font-weight: 500;
    color: #2563eb;
    margin-bottom: 20px;
    padding-left: 14px;
    border-left: 6px solid #1e40af;
}

/* Presenter */
.presenter{
    font-size: 15px;
    background: #eef2ff;
    padding: 14px 20px;
    border-radius: 12px;
    margin-bottom: 25px;
    font-weight: 600;
    color: #1e3a8a;
}

/* Program List */
.program-list{
    list-style: none;
}
.program-list li{
    position: relative;
    background: #f9fafb;
    margin: 20px;
    padding: 10px 10px 10px 55px;
    margin-bottom: 5px;
    border-radius: 10px;
    transition: all 0.3s ease;
    font-size: 15px;
    color: #1f2933;
}
.program-list li:hover{
    background: #eef2ff;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}
.program-list li::before{
    content: counter(li);
    counter-increment: li;
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    background: #2563eb;
    color: #fff;
    font-weight: 700;
    padding: 7px 10px;
    border-radius: 50%;
    font-size: 14px;
    margin: 3px;
}

/* Initialize counter for program list */
ol.program-list{
    counter-reset: li;
}

/* Break Section */
.break{
    margin: 50px 0;
    padding: 20px;
    text-align: center;
    border-radius: 14px;
    border: 2px dashed #2563eb;
    background: #fffbea;
    font-weight: 600;
    font-size: 15px;
}

/* Divider Line */
.divider{
    border: 0;
    height: 2px;
    background: linear-gradient(to right, #2563eb, #1e40af);
    margin: 35px 0;
    border-radius: 2px;
}

/* Footer */
.footer{
    text-align: center;
    margin-top: 50px;
    font-size: 14px;
    color: #6b7280;
}
</style>
</head>

<body>

<button class="back-btn" onclick="history.back()">←</button>

<div class="page">
<div class="poster">

<!-- HEADER -->
<div class="header">
    <h2>ကွန်ပျူတာတက္ကသိုလ် (သထုံ)</h2>
    <h4><b>၂၀၂၅ – ၂၀၂၆ ပညာသင်နှစ်</b></h4>
    <h4>
        မောင်မယ်သစ်လွင်ကြိုဆိုပွဲ နှင့်<br>
        ပညာရည်ချွန်ဆုပေးပွဲ အခမ်းအနား
    </h4>
</div>
<hr class="divider">

<!-- MORNING PART -->
<div class="section">
<div class="section-title">အခမ်းအနား (ပထမပိုင်း) အစီအစဉ်များ</div>

<div class="presenter">
<b>အစီအစဉ်တင်ဆက်သူများ</b><br><span style="color: black; font-size: 14px;">သူရမွန်၊ နွေးသူဇာလှိုင်၊ သစ်ဆန်း၊ ဖွေးဖွေး</span>
</div>

<ol class="program-list">
<li>အခမ်းအနား စတင်ဖွင့်လှစ်ကြောင်း ကြေညာခြင်း</li>
<li>ပါမောက္ခချုပ် ဆရာမကြီး ဒေါက်တာနီလာသိန်းမှ အဖွင့်အမှာ စကားပြောကြားခြင်း</li>
<li>စတုတ္ထနှစ် ကျောင်းသားတစ်ဦးမှ မောင်မယ်သစ်လွင်များအား ကြိုဆိုနှုတ်ခွန်းဆက်စကား ပြောကြားခြင်း</li>
<li>ပထမနှစ်ကျောင်းသားတစ်ဦးမှ ကျေးဇူးတင်စကားပြောကြားခြင်း</li>
<li>ပထမနှစ်ကျောင်းသား/သူ များမှ ကျောင်းသီချင်းဖြင့် သီဆိုဖျော်ဖြေခြင်း</li>
<li>ဒုတိယနှစ်ကျောင်းသား/သူ များမှ မြကျွန်းညိုသီချင်းဖြင့် သီဆိုဖျော်ဖြေခြင်း</li>
<li>ပထမနှစ်ကျောင်းသား/သူ များမှ ကရင်ဒုံးယိမ်းအကဖြင့် ကပြဖျော်ဖြေခြင်း</li>
<li>ပညာရည်ချွန် ဆုရရှိသော ကျောင်းသား/သူ များအားဆုချီးမြှင့်ခြင်း</li>
<li>ဒုတိယနှစ်ကျောင်းသား/သူ များမှ မွန်ဟင်္သာအကဖြင့် ကပြဖျော်ဖြေခြင်း</li>
<li>ပထမနှစ်ကျောင်းသား/သူ များမှ ပအိုဝ့်တိုင်းရင်းသားအကဖြင့် ကပြဖျော်ဖြေခြင်း</li>
<li>Final Year ကျောင်းသူ များမှ ပန်းကမ္ဘာမျှော်စင်အကဖြင့် ကပြဖျော်ဖြေခြင်း</li>
<li>စတုတ္ထနှစ်ကျောင်းသား/သူ များမှ အဖြူရောင်သံစဉ်အကဖြင့် ကပြဖျော်ဖြေခြင်း</li>
<li>ပထမနှစ်ကျောင်းသား/သူ များမှ တစ်ခါကတက္ကသိုလ်သီချင်းဖြင့် ကပြဖျော်ဖြေခြင်း</li>
<li>King & Queen Selection များနှင့် မိတ်ဆက်ခြင်း</li>
<li>ပထမနှစ်ကျောင်းသား/သူ များမှ မွန်ရိုးရာစုံတွဲအကဖြင့် ကပြဖျော်ဖြေခြင်း</li>
<li>တတိယနှစ်ကျောင်းသား/သူ များမှ ယိမ်းအကဖြင့် ကပြဖျော်ဖြေခြင်း</li>
<li>စတုတ္ထနှစ်ကျောင်းသား/သူ များမှ ထာဝရမြန်မာသီချင်းဖြင့် ကပြဖျော်ဖြေခြင်း</li>
<li>ဒုတိယနှစ်ကျောင်းသူများမှ လက်တီး ရှမ်းသီချင်းဖြင့် ကပြဖျော်ဖြေခြင်း</li>
<li>အခမ်းအနား (ပထမပိုင်း) အစီအစဥ်ပြီးဆုံးကြောင်း ကြေညာခြင်း</li>
</ol>
</div>

<div class="break">
ဆရာ/ဆရာမများနှင့် ကျောင်းသား/သူများအား နေ့လည်စာဖြင့် တည်ခင်းဧည့်ခံကျွေးမွေးခြင်း
</div>

<!-- EVENING PART -->
<div class="section">
<div class="section-title">အခမ်းအနား (ဒုတိယပိုင်း) အစီအစဉ်များ</div>

<div class="presenter">
<b>အစီအစဉ်တင်ဆက်သူများ</b><br><span style="color: black; font-size: 14px;">မြင့်မြတ်သူရနိုင်၊ ဇွန်ကဗျာစိုး၊ ဇင်မင်းဦး၊ သိင်္ဂီရွှေစင်</span>
</div>

<ol class="program-list">
<li>ညနေပိုင်းအခမ်းအနား ဖွင့်လှစ်ကြောင်း ကြေညာခြင်း</li>
<li>ကရင်မောင်မယ်များအဖွဲ့မှ ကပြဖျော်ဖြေခြင်း</li>
<li>ဒုတိယနှစ် ကျောင်းသား/သူများမှ ဗီယမ်နမ်အကဖြင့် ကပြဖျော်ဖြေခြင်း</li>
<li>တတိယနှစ်ကျောင်းသား/သူ များမှ ပအိုဝ့်တိုင်းရင်းသားအကဖြင့် ကပြဖျော်ဖြေခြင်း</li>
<li>ပထမနှစ်ကျောင်းသား/သူ များမှ ဒီဇင်ဘာ၂၈သီချင်းဖြင့် ကပြဖျော်ဖြေခြင်း</li>
<li>Music Club မှ သီချင်းများဖြင့် သီဆိုဖျော်ဖြေခြင်း</li>
<li>ဒုတိယနှစ်ကျောင်းသား/သူ များမှ စိန်အိုးစည်အကဖြင့် ကပြဖျော်ဖြေခြင်း</li>
<li>စတုတ္ထနှစ်ကျောင်းသူ များမှ အင်းလေးတိုက်တေးသီချင်းဖြင့် ကပြဖျော်ဖြေခြင်း</li>
<li>ဒုတိယနှစ်ကျောင်းသား/သူ များမှ မွန်ယိမ်းဖြင့် ကပြဖျော်ဖြေခြင်း</li>
<li>ဒုတိယနှစ်ကျောင်းသား/သူ များမှ ပအိုဝ့်တိုင်းရင်းသားအကဖြင့် ကပြဖျော်ဖြေခြင်း</li>
<li>ပထမနှစ်ကျောင်းသား/သူ များမှ ကရင်ပျိုဖြူလေးများအကဖြင့် ကပြဖျော်ဖြေခြင်း</li>
<li>တတိယနှစ်ကျောင်းသား/သူ များမှ ဟိန္ဒူအကဖြင့် ကပြဖျော်ဖြေခြင်း</li>
<li>Music Club မှ သီချင်းများဖြင့် သီဆိုဖျော်ဖြေခြင်း</li>
<li>တစ်ရွာသားအချစ် သီချင်းအား တေးသရုပ်ဖော်ဖြင့် ဖျော်ဖြေခြင်း</li>
<li>စတုတ္ထနှစ်ကျောင်းသား/သူများမှ ရွှင်လန်းကာစိတ်ချမ်းသာကြစေသီချင်းဖြင့် ကပြဖျော်ဖြေခြင်း</li>
<li>နာမည်တပ်ပြီး ပြောပိုင်ခွင့်မရှိသီချင်းဖြင့် ကပြဖျော်ဖြေခြင်း</li>
<li>Selection Evening Gown</li>
<li>Music Club မှ သီချင်းများဖြင့် သီဆိုဖျော်ဖြေခြင်း</li>
<li>စတုတ္ထနှစ်ကျောင်းသား/သူ များမှ Like Jennie သီချင်းဖြင့် ကပြဖျော်ဖြေခြင်း</li>
<li>Lucky Draw</li>
<li>တတိယနှစ်ကျောင်းသား/သူ များမှ မွန်သင်္ကြန်မယ်အကဖြင့် ကပြဖျော်ဖြေခြင်း</li>
<li>စတုတ္ထနှစ်ကျောင်းသား/သူ များမှ နားပန်ဆံသီချင်းဖြင့် ကပြဖျော်ဖြေခြင်း</li>
<li>တတိယနှစ်ကျောင်းသား မောင်အပ်ခေတ်မှ မွန်သီချင်းဖြင့် သီဆိုဖျော်ဖြေခြင်း</li>
<li>စတုတ္ထနှစ်ကျောင်းသူ များမှ English remix song ဖြင့် ကပြဖျော်ဖြေခြင်း</li>
<li>တတိယနှစ်ကျောင်းသူ များမှ Ok Naka သီချင်းဖြင့် ကပြဖျော်ဖြေခြင်း</li>
<li>Music Club မှ သီချင်းများဖြင့် သီဆိုဖျော်ဖြေခြင်း</li>
<li>King/Queen ဆုပေးပွဲ</li>
<li>အခမ်းအနား ပြီးမြောက်ကြောင်း ကြေညာခြင်း</li>
</ol>
</div>

<div class="footer">
© 2026 University of Computer Studies (Thaton)
</div>

</div>
</div>

</body>
</html>
