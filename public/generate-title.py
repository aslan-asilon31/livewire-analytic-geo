import os

# Folder gambar lokal
folder = "icons-img"

# Ambil semua file di folder
image_files = [f for f in os.listdir(folder) if f.lower().endswith(('.png', '.jpg', '.jpeg', '.svg'))]

titles = []
urls = []

for filename in image_files:
    # Hilangkan ekstensi dan ubah dash ke spasi
    name_without_ext = os.path.splitext(filename)[0]
    title = name_without_ext.replace("-", " ").title()

    # Tambahkan ke list
    titles.append(title)
    urls.append(f"{folder}/{filename}")

# Tampilkan hasil
for title, url in zip(titles, urls):
    print(f"Title: {title}, URL: {url}")
