import re

with open('admin/index.php', 'r', encoding='utf-8') as f:
    text = f.read()

# 1. Update the Save All buttons so they don't jump to the bottom. They are currently wrapped in <div class="sticky bottom-6 mt-16 z-30 pt-4">.
# The `sticky` behaviour wasn't working properly because the parent div does not establish a scrolling context that makes sticky work well at the very bottom, OR the page is just too long.
# Change them to `fixed bottom-6 right-6 ... w-full md:w-auto` so they float.

text = re.sub(
    r'<div class="sticky bottom-6 mt-16 z-30 pt-4">\s*(<button type="submit"[\s\S]*?Save General Settings[\s\S]*?</button>)\s*</div>',
    r'<div class="fixed bottom-24 md:bottom-10 right-6 z-[90]"><button type="submit" class="bg-black text-white font-black text-xl md:text-2xl px-8 py-4 uppercase tracking-widest border-[4px] border-black brutal-shadow-lg hover:bg-gray-800 hover:scale-105 active:scale-95 transition-all text-center"><i class="fa-solid fa-floppy-disk"></i> Save General</button></div>',
    text
)

text = re.sub(
    r'<div class="sticky bottom-6 mt-16 z-30 pt-4">\s*(<button type="submit"[\s\S]*?Save Music Configuration[\s\S]*?</button>)\s*</div>',
    r'<div class="fixed bottom-24 md:bottom-10 right-6 z-[90]"><button type="submit" class="bg-[#00e5ff] text-black font-black text-xl md:text-2xl px-8 py-4 uppercase tracking-widest border-[4px] border-black brutal-shadow-lg hover:bg-cyan-300 hover:scale-105 active:scale-95 transition-all text-center"><i class="fa-solid fa-floppy-disk"></i> Save Music</button></div>',
    text
)

text = re.sub(
    r'<div class="sticky bottom-6 mt-16 z-30 pt-4">\s*(<button type="submit"[\s\S]*?Save Gallery Configuration[\s\S]*?</button>)\s*</div>',
    r'<div class="fixed bottom-24 md:bottom-10 right-6 z-[90]"><button type="submit" class="bg-[#ff00ff] text-white font-black text-xl md:text-2xl px-8 py-4 uppercase tracking-widest border-[4px] border-black brutal-shadow-lg hover:bg-pink-600 hover:scale-105 active:scale-95 transition-all text-center shadow-[6px_6px_0px_#000]"><i class="fa-solid fa-floppy-disk"></i> Save Gallery</button></div>',
    text
)

# 2. Add Delete Icon/Button inside the Item Cards:
# For Music:
music_find = r'(<div class="flex-grow w-full overflow-hidden">[\s\S]*?name="music_meta\[link\]"[\s\S]*?class="[^"]*?")\s*(>)'
music_replace = r'\1>\n                                              <!-- Delete trigger -->\n                                              <button type="button" onclick="confirmDelete(\'del-music-<?php echo $index; ?>\', \'<?php echo htmlspecialchars(addslashes($item[\'title\'] ?: \'This item\')); ?>\')" class="absolute -top-4 -right-4 bg-red-500 text-white w-10 h-10 rounded-full border-4 border-black brutal-shadow flex items-center justify-center hover:bg-red-700 hover:scale-110 active:scale-95 transition-all z-50 text-xl font-bold" title="Delete Release">&times;</button>'
text = re.sub(music_find, music_replace, text)

# For Gallery:
gallery_find = r'(<div class="flex-grow w-full overflow-hidden">[\s\S]*?name="gallery_meta\[classes\]"[\s\S]*?class="[^"]*?")\s*(>)'
gallery_replace = r'\1>\n                                              <!-- Delete trigger -->\n                                              <button type="button" onclick="confirmDelete(\'del-gallery-<?php echo $index; ?>\', \'Photo frame #<?php echo $index + 1; ?>\')" class="absolute -top-4 -right-4 bg-red-500 text-white w-10 h-10 rounded-full border-4 border-black brutal-shadow flex items-center justify-center hover:bg-red-700 hover:scale-110 active:scale-95 transition-all z-50 text-xl font-bold" title="Delete Photo">&times;</button>'
text = re.sub(gallery_find, gallery_replace, text)


# 3. Remove the 'Danger Zone' delete sections entirely to avoid redundancy.
text = re.sub(r'<!-- Dedicated Delete Zone \(Cleaner UX\) -->[\s\S]*?</div>\s*<?php endif; ?>', '', text)


# 4. Insert the Custom Tailwind Modal HTML and JS before the closing </body> tag.
custom_modal_html = """

    <!-- Custom Confirm Delete Modal -->
    <div id="delete-modal" class="hidden fixed inset-0 z-[200] bg-black bg-opacity-70 flex items-center justify-center p-4 backdrop-blur-sm transition-opacity">
        <div class="bg-white border-[6px] border-black brutal-shadow-lg w-full max-w-sm overflow-hidden transform -rotate-1 relative">
            <div class="absolute -top-4 -right-4 bg-red-500 w-12 h-12 rounded-full border-4 border-black z-0"></div>
            <div class="bg-red-600 text-white border-b-4 border-black p-4 flex justify-between items-center relative z-10">
                <h2 class="font-black text-2xl uppercase tracking-widest"><i class="fa-solid fa-triangle-exclamation"></i> Warning</h2>
            </div>
            <div class="p-6 relative z-10">
                <p class="font-bold text-lg mb-6 leading-tight border-b-2 border-red-200 pb-4">
                    Are you incredibly sure you want to permanently delete <br/><span id="delete-target-name" class="font-black text-red-600 text-xl inline-block mt-2 bg-red-100 px-2 py-1 transform rotate-1 border-2 border-red-300"></span> ?
                </p>
                <div class="flex gap-4">
                    <button type="button" onclick="closeDeleteModal()" class="flex-1 bg-white text-black font-black p-3 border-[4px] border-black brutal-shadow hover:-translate-y-1 active:translate-y-0 transition-transform uppercase focus:outline-none">
                        Cancel
                    </button>
                    <button type="button" id="confirm-delete-btn" class="flex-1 bg-red-600 text-white font-black p-3 border-[4px] border-black brutal-shadow hover:bg-red-700 hover:-translate-y-1 active:translate-y-0 transition-transform uppercase focus:outline-none">
                        Delete It!
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script to handle custom delete modal -->
    <script>
        let currentDeleteFormId = null;

        function confirmDelete(formId, targetName) {
            currentDeleteFormId = formId;
            document.getElementById('delete-target-name').innerText = targetName;
            document.getElementById('delete-modal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('delete-modal').classList.add('hidden');
            currentDeleteFormId = null;
        }

        document.getElementById('confirm-delete-btn').addEventListener('click', function() {
            if (currentDeleteFormId) {
                document.getElementById(currentDeleteFormId).submit();
            }
        });
    </script>
"""

if '<!-- Custom Confirm Delete Modal -->' not in text:
    text = text.replace('</body>', custom_modal_html + '\n</body>')


with open('admin/index.php', 'w', encoding='utf-8') as f:
    f.write(text)

print("Patch applied!")
