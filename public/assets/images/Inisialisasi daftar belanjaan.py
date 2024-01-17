# Inisialisasi daftar belanjaan
belanjaan = []

# Fungsi untuk menambahkan item ke keranjang belanja
def tambah_item():
    nama = input("Masukkan nama barang: ")
    harga = float(input("Masukkan harga barang: "))
    jumlah = int(input("Masukkan jumlah barang: "))
    total = harga * jumlah
    belanjaan.append((nama, harga, jumlah, total))
    print(f"{nama} telah ditambahkan ke keranjang belanja.")

# Fungsi untuk menghitung total belanjaan
def hitung_total():
    total_belanja = sum(item[3] for item in belanjaan)
    return total_belanja

# Fungsi untuk mencetak struk pembayaran
def cetak_struk(total):
    print("\n===== Struk Pembayaran =====")
    for item in belanjaan:
        print(f"{item[0]}: {item[1]} x {item[2]} = {item[3]}")
    print(f"Total: {total}")
    print("==============================")

# Program utama
while True:
    print("\nMenu:")
    print("1. Tambah Item ke Keranjang")
    print("2. Hitung Total dan Cetak Struk")
    print("3. Keluar")

    pilihan = input("Pilih menu (1/2/3): ")

    if pilihan == "1":
        tambah_item()
    elif pilihan == "2":
        total_belanja = hitung_total()
        cetak_struk(total_belanja)
    elif pilihan == "3":
        print("Terima kasih! Sampai jumpa lagi.")
        break
    else:
        print("Pilihan tidak valid. Silakan pilih 1, 2, atau 3.")
