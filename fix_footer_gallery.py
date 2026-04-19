import re

with open('index.php', 'r', encoding='utf-8') as f:
    text = f.read()

# 1. Fix Gallery Items Clustering (remove `md:absolute` and add margin/cursor back to restore flex flow)
old_gallery = '''<div class="polaroid bg-white p-4 pb-12 border-[4px] border-ink bg-white transition-all duration-300 md:absolute scale-90 md:scale-100 shadow-brutal-md hover:shadow-brutal-lg z-[10] hover:z-[60] <?php echo htmlspecialchars($photo['classes']); ?>"'''

new_gallery = '''<div class="polaroid bg-white p-3 md:p-4 pb-10 md:pb-12 border-[4px] border-ink cursor-grab hover:z-50 m-4 shadow-brutal-md transition-all duration-300 hover:scale-105 active:scale-95 <?php echo htmlspecialchars($photo['classes']); ?>"'''

if old_gallery in text:
    text = text.replace(old_gallery, new_gallery)

# 2. Restore Footer Contact Section
# See if contact section is missing
if 'id="contact"' not in text:
    # Append it right before </main>
    contact_section = """
    <!-- Contact Section -->
    <section id="contact" class="relative w-full min-h-screen flex items-center justify-center pb-24 md:pb-0 z-30 pt-32 overflow-hidden bg-cover bg-center" style="background-image: radial-gradient(circle, var(--color-accent-blue) 10%, transparent 10.5%), radial-gradient(circle, var(--color-accent-pink) 10%, transparent 10.5%); background-size: 30px 30px; background-position: 0 0, 15px 15px; opacity: 0.95;">
      <div class="relative w-full max-w-4xl mx-auto px-4 flex flex-col items-center">
        <!-- Large Sticky Note -->
        <div class="bg-accent-yellow w-full md:w-3/4 max-w-2xl border-[4px] border-ink shadow-brutal-lg p-8 md:p-14 relative rotate-2 interactive-hover transition-transform duration-300 hover:rotate-1">
          <!-- Virtual Pin -->
          <div class="w-8 h-8 rounded-full bg-red-500 border-2 border-white shadow-md absolute -top-4 left-1/2 transform -translate-x-1/2">
            <div class="w-2 h-2 rounded-full bg-white absolute top-1 right-2 opacity-70"></div>
          </div>
          <h2 class="font-marker text-5xl md:text-7xl mb-4 text-center">Let's Connect</h2>
          <p class="font-handwriting text-2xl md:text-4xl text-center mb-10 leading-relaxed text-opacity-80">
            Got a beat? A show? Or just wanna say hi?<br />Drop me a line, I don't bite. <i class="fa-solid fa-guitar"></i>
          </p>
          <div class="flex flex-col gap-4 max-w-md mx-auto">
            <a href="mailto:69.prince.0112@gmail.com" class="bg-white border-[3px] border-ink p-4 flex items-center gap-4 hover-wiggle group cursor-pointer transition-colors hover:bg-accent-pink shadow-brutal-sm">
              <i class="fa-solid fa-envelope-open-text text-3xl group-hover:text-white transition-colors"></i>
              <div>
                <h4 class="font-mono font-bold text-lg leading-none group-hover:text-white">Email</h4>
                <span class="font-sans text-sm text-gray-600 group-hover:text-gray-200">69.prince.0112@gmail.com</span>
              </div>
            </a>
            <div class="grid grid-cols-2 gap-4 mt-2">
              <a href="https://instagram.com/prince_on_guitar" target="_blank" class="bg-ink text-white border-[3px] border-ink p-4 flex justify-center items-center gap-2 hover:-translate-y-1 hover:shadow-brutal-sm transition-all rotate-[-1deg] hover:bg-accent-blue hover:text-ink">
                <i class="fa-brands fa-instagram text-2xl"></i><span class="font-mono font-bold">Instagram</span>
              </a>
              <a href="https://www.youtube.com/@Prince_on_guitar" target="_blank" class="bg-ink text-white border-[3px] border-ink p-4 flex justify-center items-center gap-2 hover:-translate-y-1 hover:shadow-brutal-sm transition-all rotate-[1deg] hover:bg-red-500 hover:text-white">
                <i class="fa-brands fa-youtube text-2xl"></i><span class="font-mono font-bold">YouTube</span>
              </a>
              <a href="#" class="bg-ink text-white border-[3px] border-ink p-4 flex justify-center items-center gap-2 hover:-translate-y-1 hover:shadow-brutal-sm transition-all rotate-[2deg] hover:bg-black hover:text-white">
                <i class="fa-brands fa-tiktok text-2xl"></i><span class="font-mono font-bold">TikTok</span>
              </a>
              <a href="#" class="bg-ink text-white border-[3px] border-ink p-4 flex justify-center items-center gap-2 hover:-translate-y-1 hover:shadow-brutal-sm transition-all rotate-[-2deg] hover:bg-[#1DB954] hover:text-ink">
                <i class="fa-brands fa-spotify text-2xl"></i><span class="font-mono font-bold">Spotify</span>
              </a>
            </div>
          </div>
          <div class="absolute bottom-6 right-6 font-marker text-4xl text-ink transform rotate-[-10deg] opacity-70">- Prince</div>
        </div>
        <div class="mt-20 text-center flex flex-col items-center">
          <p class="font-mono text-ink bg-white border-2 border-ink px-4 py-1 rotate-1 shadow-brutal-sm inline-block">
            <?php echo isset($data['contact']['footer']) ? htmlspecialchars($data['contact']['footer']) : '© 2026 Prince Neupane. All rights reserved.'; ?>
          </p>
          <p class="font-handwriting text-xl mt-4 text-ink">Built with ❤️ from the 90s.</p>
          <a href="https://github.com/zenithkandel" target="_blank" class="font-mono text-sm mt-6 text-gray-800 hover:text-accent-pink transition-colors underline underline-offset-4 font-bold decoration-2 mb-10">Made by Zenith</a>
        </div>
      </div>
    </section>
"""
    text = text.replace('</main>', contact_section + '\n  </main>')

with open('index.php', 'w', encoding='utf-8') as f:
    f.write(text)

print("Restored Footer and Fixed Gallery Image Rendering!")
