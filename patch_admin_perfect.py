import re

with open('admin/index.php', 'r', encoding='utf-8') as f:
    text = f.read()

# 1. Update the Save All buttons so they don't jump to the bottom
text = re.sub(
    r'<div class="sticky bottom-6 mt-16 z-30 pt-4">\s*(<button type="submit"[^>]*?>\s*<i class="fa-solid fa-floppy-disk"></i> Save General Settings\s*</button>)\s*</div>',
    '<div class="fixed bottom-24 md:bottom-10 right-6 z-[90]"><button type="submit" class="bg-black text-white font-black text-xl md:text-2xl px-8 py-4 uppercase tracking-widest border-[4px] border-black brutal-shadow-lg hover:bg-gray-800 hover:scale-105 active:scale-95 transition-all text-center"><i class="fa-solid fa-floppy-disk"></i> Save General</button></div>',
    text
)

text = re.sub(
    r'<div class="sticky bottom-6 mt-16 z-30 pt-4">\s*(<button type="submit"[^>]*?>\s*<i class="fa-solid fa-floppy-disk"></i> Save Music Configuration\s*</button>)\s*</div>',
    '<div class="fixed bottom-24 md:bottom-10 right-6 z-[90]"><button type="submit" class="bg-[#00e5ff] text-black font-black text-xl md:text-2xl px-8 py-4 uppercase tracking-widest border-[4px] border-black brutal-shadow-lg hover:bg-cyan-300 hover:scale-105 active:scale-95 transition-all text-center"><i class="fa-solid fa-floppy-disk"></i> Save Music</button></div>',
    text
)

text = re.sub(
    r'<div class="sticky bottom-6 mt-16 z-30 pt-4">\s*(<button type="submit"[^>]*?>\s*<i class="fa-solid fa-floppy-disk"></i> Save Gallery Configuration\s*</button>)\s*</div>',
    '<div class="fixed bottom-24 md:bottom-10 right-6 z-[90]"><button type="submit" class="bg-[#ff00ff] text-white font-black text-xl md:text-2xl px-8 py-4 uppercase tracking-widest border-[4px] border-black brutal-shadow-lg hover:bg-pink-600 hover:scale-105 active:scale-95 transition-all text-center shadow-[6px_6px_0px_#000]"><i class="fa-solid fa-floppy-disk"></i> Save Gallery</button></div>',
    text
)

# 2. Add Delete Buttons
# Find music card header
music_find = r'<!-- Card Header -->\s*<div\s+class="absolute -top-5 -left-5 bg-black text-\[#00e5ff\]'
music_replace = """<!-- Card Header -->
                                    <!-- Delete Button -->
                                    <button type="button" onclick="confirmDelete('del-music-<?php echo $index; ?>', '<?php echo htmlspecialchars(addslashes($item['title'] ?: 'Item #'.($index+1))); ?>')" class="absolute -top-4 -right-4 bg-red-500 text-white w-10 h-10 rounded-full border-4 border-black brutal-shadow flex items-center justify-center hover:bg-red-700 hover:scale-110 active:scale-95 transition-all z-50 text-xl font-bold" title="Delete Release">&times;</button>
                                    <div
                                        class="absolute -top-5 -left-5 bg-black text-[#00e5ff]"""
text = re.sub(music_find, music_replace, text)

# Find gallery card header
gallery_find = r'<!-- Card Header -->\s*<div\s+class="absolute -top-5 -left-5 bg-\[#ff00ff\] text-white'
gallery_replace = """<!-- Card Header -->
                                    <!-- Delete Button -->
                                    <button type="button" onclick="confirmDelete('del-gallery-<?php echo $index; ?>', 'Photo frame #<?php echo $index + 1; ?>')" class="absolute -top-4 -right-4 bg-red-500 text-white w-10 h-10 rounded-full border-4 border-black brutal-shadow flex items-center justify-center hover:bg-red-700 hover:scale-110 active:scale-95 transition-all z-50 text-xl font-bold" title="Delete Photo">&times;</button>
                                    <div
                                        class="absolute -top-5 -left-5 bg-[#ff00ff] text-white"""
text = re.sub(gallery_find, gallery_replace, text)


# 3. Cleanly remove the Danger Zones
music_dz = "<!-- Dedicated Delete Zone (Cleaner UX) -->\n                <?php if (!empty($data['music']['releases'])): ?>"
if music_dz in text:
    start_idx = text.find(music_dz)
    endloop_idx = text.find('<?php endforeach; ?>', start_idx)
    next_endif_idx = text.find('<?php endif; ?>', endloop_idx)
    if endloop_idx != -1 and next_endif_idx != -1:
        end_idx = next_endif_idx + len('<?php endif; ?>')
        text = text[:start_idx] + text[end_idx:]

gallery_dz = "<!-- Dedicated Delete Zone (Cleaner UX) -->\n                <?php if (!empty($data['gallery']['images'])): ?>"
if gallery_dz in text:
    start_idx = text.find(gallery_dz)
    endloop_idx = text.find('<?php endforeach; ?>', start_idx)
    next_endif_idx = text.find('<?php endif; ?>', endloop_idx)
    if endloop_idx != -1 and next_endif_idx != -1:
        end_idx = next_endif_idx + len('<?php endif; ?>')
        text = text[:start_idx] + text[end_idx:]


# 4. Insert Modal code precisely
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

print("Safely rebuilt admin UI without syntax errors!")
