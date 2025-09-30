<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>ހެނދުނާއި ހަވީރުގެ ޛިކުރު</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Amiri&family=Scheherazade+New&family=Cairo:wght@700&family=Lateef&family=Reem+Kufi:wght@700&display=swap');
    @font-face {
      font-family: 'MVTyper';
      src: url('data:font/ttf;base64,AAEAAAARAQAABAAQR0RFRgDEAbEAAAEcAAA...'); /* Truncated for brevity */
      font-weight: normal;
      font-style: normal;
    }
    /* ... All your CSS exactly as-is ... */
  </style>
</head>
<body class="theme-dark">
<?php
// ----------- PHP Dhikr Data -------------
$morningSlides = [
  [
    "text" => "أَصْبَحْنَا وَأَصْبَحَ الْمُلْكُ للهِ وَالْحَمْدُ للهِ ، لاَ إِلَهَ إِلاَّ اللهُ وَحْدَهُ لاَ شَرِيكَ لَهُ، لَهُ الْمُلْكُ وَلَهُ الْحَمْدُ، وَهُوَ عَلَى كُلِّ شَىْءٍ قَدِيرٌ ، رَبِّ أَسْأَلُكَ خَيْرَ مَا فِيْ هَذَا الْيَوْمِ وَخَيْرَ مَا بَعْدَهُ ، وَأَعُوْذُ بِكَ مِنْ شَرِّ مَا فِي هَذَا الْيَوْمِ وَشَرِّ مَا بَعْدَهُ، رَبِّ أَعُوْذُ بِكَ مِنَ الكَسَلِ، وَسُوءِ الكِبَرِ، رَبِّ أَعُوْذُ بِكَ مِنْ عَذَابٍ فِي النَّارِ وَعَذَابٍ فِي الْقَبْرِ",
    "meaning" => "އަޅަމެން ހެނދުނު ކޮށްފީމުއެވެ....", // Truncated for brevity
    "clicks" => 1
  ],
  // ... Add all other slides as PHP arrays ...
];

$eveningSlides = [
  [
    "text" => "أمْسَيْنَا وَأَمْسَى الْمُلْكُ للهِ ، وَالْحَمْدُ للهِ ، وَلاَ إِلَهَ إِلاَّ اللهُ وَحْدَهُ لاَ شَرِيكَ لَهُ ، لَهُ الْمُلْكُ ، وَلَهُ الْحَمْدُ ، وَهُوَ عَلَى كُلِّ شَىْءٍ قَدِيرٌ ، رَبِّ أَسْأَلُكَ خَيْرَ مَا فِيْ هَذِهِ اللَّيْلَةِ وَخَيْرَ مَا بَعْدَهَا...",
    "meaning" => "އަޅަމެން ހަވީރުކޮށްފީމުއެވެ....", // Truncated for brevity
    "clicks" => 1
  ],
  // ... Add all other slides as PHP arrays ...
];

function isMorning() {
  $hour = intval(date("G"));
  return $hour >= 5 && $hour <= 12;
}
$slideMode = isMorning() ? 'morning' : 'evening';
$slides = $slideMode === 'morning' ? $morningSlides : $eveningSlides;
$headerText = $slideMode === 'morning' ? "ހެނދުނުގެ ޛިކުރުތަށް" : "ހަވީރުގެ ޛިކުރުތަށް";
$currentSlide = 0;
$clickCount = 0;
$fontSize = 18;
$selectedFont = "'Amiri', serif";
?>
  <div class="main-content" id="main-content">
    <div class="header-slide" id="header-slide"><?php echo $headerText; ?></div>
    <div class="slide" id="slide"><?php echo $slides[$currentSlide]['text']; ?></div>
    <section class="meaning-section" id="meaning-section">
      <strong>މާނަ:</strong> <?php echo $slides[$currentSlide]['meaning']; ?>
    </section>
  </div>
  <div class="footer">
    <span class="footer-info" id="footer-info">
      <!-- Dynamic info goes here -->
    </span>
    <div class="footer-arrows">
      <button class="footer-arrow-btn" id="prev-dhikr" title="ކުރީގެ ޛިދުކުރު"><</button>
      <button class="footer-arrow-btn" id="next-dhikr" title="އަނެއް ޛިކުރު">></button>
    </div>
    <button class="slide-switch-btn" id="slide-switch-btn">ހަވީރުގެ ޛިކުރު</button>
    <button class="theme-switch-btn" id="theme-switch-btn" title="Toggle theme"></button>
    <button class="settings-btn" id="settings-btn" title="Settings">&#9881;</button>
  </div>
  <div class="popup-overlay" id="popup-overlay"></div>
  <div class="popup-settings" id="popup-settings">
    <button class="close-settings" id="close-settings" title="Close">&times;</button>
    <div class="popup-settings-row">
      <label for="font-size">ފޮންޓް ސައިޒް:</label>
      <input type="range" id="font-size" min="10" max="32" value="14">
      <span id="font-size-value">14px</span>
    </div>
    <div class="popup-settings-row">
      <label for="arabic-font">ފޮންޓް:</label>
      <select id="arabic-font">
        <option value="'Amiri', serif" selected>الأميري</option>
        <option value="'Scheherazade New', serif">سِلسلة جديدة من شهرزاد</option>
        <option value="'Cairo', sans-serif">قاهرة</option>
        <option value="'Lateef', serif">لطيف </option>
        <option value="'Reem Kufi', sans-serif">كوفي ريم</option>
      </select>
    </div>
  </div>
  <script>
    // --- JS: You can keep the JS as is, or
    // You can pass PHP variables to JS if you want dynamic slide logic:
    let morningSlides = <?php echo json_encode($morningSlides, JSON_UNESCAPED_UNICODE); ?>;
    let eveningSlides = <?php echo json_encode($eveningSlides, JSON_UNESCAPED_UNICODE); ?>;
    // The rest of your JS code ...
    // You may want to move all slide logic to JS for full interactivity, using what you did before in HTML
    // ...
  </script>
</body>
</html>
