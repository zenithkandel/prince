import re

with open('index.php', 'r', encoding='utf-8') as f:
    text = f.read()

# Make Hero Dynamic
text = text.replace('<i class="fa-brands fa-youtube mr-2"></i> @Prince_on_guitar', '<i class="fa-brands fa-youtube mr-2"></i> <?php echo htmlspecialchars($data[\'hero\'][\'tag\']); ?>')
text = text.replace('<span class="block relative z-10 transition-transform \nhover:-translate-y-2 duration-300">Prince</span>', '<span class="block relative z-10 transition-transform hover:-translate-y-2 duration-300"><?php echo htmlspecialchars($data[\'hero\'][\'title_first\']); ?></span>')
text = text.replace('">Neupane</span>', '"><?php echo htmlspecialchars($data[\'hero\'][\'title_last\']); ?></span>')
text = text.replace('Guitarist. Vocalist. Creator.', '<?php echo htmlspecialchars($data[\'hero\'][\'subtitle\']); ?>')
text = text.replace('NP Nepal → CA Toronto', '<?php echo htmlspecialchars($data[\'hero\'][\'location\']); ?>')
text = text.replace('Hit Play', '<?php echo htmlspecialchars($data[\'hero\'][\'cta\']); ?>')
text = text.replace('src="images/prince-img-01.jpg"', 'src="<?php echo htmlspecialchars($data[\'hero\'][\'img\']); ?>"')
text = text.replace('me! <i class="fa-solid fa-sparkles text-accent-yellow"></i>', '<?php echo $data[\'hero\'][\'img_caption\']; ?>')

# Make About Dynamic
text = text.replace('src="images/prince-img-02.jpg"', 'src="<?php echo htmlspecialchars($data[\'about\'][\'img\']); ?>"')
text = text.replace('Budhanilkantha Days', '<?php echo htmlspecialchars($data[\'about\'][\'img_caption\']); ?>')
text = text.replace('About Me', '<?php echo htmlspecialchars($data[\'about\'][\'title\']); ?>')

text = text.replace("Hey! I'm Prince. Born in the vibrant streets of Nepal, now making noise \nin Toronto, Canada. 🍁", "<?php echo htmlspecialchars($data['about']['content_p1']); ?>")
text = text.replace(">Voice of Nepal\n                    Kids</span>", "><?php echo htmlspecialchars($data['about']['content_highlight']); ?></span>")
text = text.replace("Making music has always been my journey. From early\n                  experiences like a brief stint on", "<?php echo htmlspecialchars(explode('<span', $data['about']['content_p2'])[0] ?? ''); ?>")
text = text.replace(", to now writing and producing my own original tracks. I play\n                guitar, I sing, and I build worlds through music.", "<?php echo htmlspecialchars(explode('</span>', $data['about']['content_p2'])[1] ?? ''); ?>")

# Instead of complex explodes for about p2 which might fail based on line breaks, let's just do a regex replace for the whole paragraph block
import re
about_p1_pattern = r'<p class="mb-4">\s*Hey! I\'m Prince. Born in the vibrant streets of Nepal, now making noise\s*in Toronto, Canada. 🍁\s*</p>'
text = re.sub(about_p1_pattern, '<p class="mb-4"><?php echo $data[\'about\'][\'content_p1\']; ?></p>', text)

about_p2_pattern = r'<p>\s*Making music has always been my journey. From early\s*experiences like a brief stint on\s*<span class="bg-accent-blue px-2 rotate-\[-1deg\] inline-block shadow-brutal-sm text-white">Voice of Nepal\s*Kids</span>, to now writing and producing my own original tracks. I play\s*guitar, I sing, and I build worlds through music.\s*</p>'
text = re.sub(about_p2_pattern, '<p><?php echo $data[\'about\'][\'content_p2\']; ?></p>', text)

text = text.replace('100%\nRaw', '<?php echo htmlspecialchars($data[\'about\'][\'badge_text\']); ?>')
text = text.replace('<i class="fa-solid fa-guitar text-3xl mb-1"></i>', '<i class="<?php echo htmlspecialchars($data[\'about\'][\'badge_icon\']); ?> text-3xl mb-1"></i>')

# Make Gallery Dynamic
gallery_pattern = r'<!-- The Grid / Scatter Canvas -->\s*<div class="relative w-full max-w-6xl h-full flex flex-wrap justify-center content-center gap-6 px-4 md:px-0">.*?</div>\s*</section>'

dynamic_gallery = """<!-- The Grid / Scatter Canvas -->
        <div class="relative w-full max-w-6xl h-full flex flex-wrap justify-center content-center gap-6 px-4 md:px-0">
          <?php foreach ($data['gallery']['images'] as $photo): ?>
          <div class="polaroid <?php echo htmlspecialchars($photo['classes']); ?> md:absolute scale-90 md:scale-100 shadow-brutal-md hover:shadow-brutal-lg z-10 hover:z-[60]"
             <?php echo !empty($photo['style']) ? 'style="'.htmlspecialchars($photo['style']).'"' : ''; ?>>
            <div class="w-64 h-80 border-[3px] border-ink overflow-hidden bg-gray-200">
              <img src="<?php echo htmlspecialchars($photo['img']); ?>" alt="Gallery" class="w-full h-full object-cover">
            </div>
            <p class="font-handwriting text-2xl text-center text-ink mt-2"><?php echo htmlspecialchars($photo['caption']); ?></p>
          </div>
          <?php endforeach; ?>
        </div>
      </section>"""

text = re.sub(gallery_pattern, dynamic_gallery, text, flags=re.DOTALL)

with open('index.php', 'w', encoding='utf-8') as f:
    f.write(text)

print("index.php refactored to use dynamic data.json values")
