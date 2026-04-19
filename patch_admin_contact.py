import re

with open('admin/index.php', 'r', encoding='utf-8') as f:
    text = f.read()

contact_section = """
                    <!-- Contact Section -->
                    <section
                        class="bg-white border-4 border-black p-6 md:p-10 brutal-shadow-lg relative group hover:border-[#1DB954] transition-colors focus-within:border-[#1DB954] mt-20">
                        <div
                            class="absolute -top-5 -left-5 bg-[#1DB954] border-4 border-black px-4 py-2 font-black transform -rotate-2 uppercase text-xl group-hover:rotate-0 transition-transform shadow-[4px_4px_0px_rgba(0,0,0,1)] z-10 text-white">
                            Contact & Links <i class="fa-solid fa-address-book"></i></div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8 mt-8 relative z-0">
                            <!-- Input Block -->
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm">Public Email</label>
                                <input type="email" name="contact[email]"
                                    value="<?php echo htmlspecialchars($data['contact']['email'] ?? ''); ?>"
                                    class="border-[3px] border-black p-4 font-mono focus:outline-none focus:ring-[4px] focus:ring-[#1DB954] transition-all bg-transparent focus:bg-white border-b-8">
                            </div>
                            <!-- Input Block -->
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm">YouTube Link</label>
                                <input type="url" name="contact[youtube]" placeholder="https://youtube.com/..." 
                                    value="<?php echo htmlspecialchars($data['contact']['youtube'] ?? ''); ?>"
                                    class="border-[3px] border-black p-4 font-mono focus:outline-none focus:ring-[4px] focus:ring-red-400 transition-all bg-transparent focus:bg-white border-b-8">
                            </div>
                            <!-- Input Block -->
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm">Instagram Link</label>
                                <input type="url" name="contact[instagram]" placeholder="https://instagram.com/..." 
                                    value="<?php echo htmlspecialchars($data['contact']['instagram'] ?? ''); ?>"
                                    class="border-[3px] border-black p-4 font-mono focus:outline-none focus:ring-[4px] focus:ring-[#ff00ff] transition-all bg-transparent focus:bg-white border-b-8">
                            </div>
                            <!-- Input Block -->
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm">TikTok Link</label>
                                <input type="url" name="contact[tiktok]" placeholder="https://tiktok.com/..." 
                                    value="<?php echo htmlspecialchars($data['contact']['tiktok'] ?? ''); ?>"
                                    class="border-[3px] border-black p-4 font-mono focus:outline-none focus:ring-[4px] focus:ring-gray-400 transition-all bg-transparent focus:bg-white border-b-8">
                            </div>
                            <!-- Input Block -->
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm">Spotify Link</label>
                                <input type="url" name="contact[spotify]" placeholder="https://spotify.com/..." 
                                    value="<?php echo htmlspecialchars($data['contact']['spotify'] ?? ''); ?>"
                                    class="border-[3px] border-black p-4 font-mono focus:outline-none focus:ring-[4px] focus:ring-[#1DB954] transition-all bg-transparent focus:bg-white border-b-8">
                            </div>
                            <!-- Input Block -->
                            <div class="flex flex-col gap-2 md:col-span-2">
                                <label class="font-bold uppercase text-sm">Footer Text</label>
                                <input type="text" name="contact[footer]"
                                    value="<?php echo htmlspecialchars($data['contact']['footer'] ?? ''); ?>"
                                    class="border-[3px] border-black p-4 font-mono focus:outline-none focus:ring-[4px] focus:ring-yellow-300 transition-all bg-gray-50 focus:bg-white">
                            </div>
                        </div>
                    </section>

                    <!-- Sticky Save Action Footer -->"""

text = text.replace('                    <!-- Sticky Save Action Footer -->', contact_section)

with open('admin/index.php', 'w', encoding='utf-8') as f:
    f.write(text)
    
print("Updated admin form")
