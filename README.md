# Shopping Cart Application

Bu proje, saf PHP kullanılarak MVC yapısında basit bir alışveriş sepeti uygulamasıdır. Uygulama, kullanıcıların ürünleri listelemesini, sepete ürün eklemesini ve sepetin içeriğini yönetmesini sağlar.

Front-end kısmı arkaplanda bırakılmıştır.

 ![shoppingCart](/img/shoppingCart.png)

---

## Proje İsterleri

- Bir dizi ürün içeriğinin sayfada listelenmesi.
- Listelenen ürünlerin sepete eklenmesi ve sepetten çıkarılması.
- Birden fazla ürün sepete eklenebilir.
- Ürünlerin tamamı ya da bir tanesi sepetten çıkarılabilir.

Patika Proje Adresi: [PHP ile Backend Patikası Projeleri - Sepet Uygulaması](https://academy.patika.dev/tr/courses/php-ile-backend-patikasi-projeleri/php-proje-sepet)

## Özellikler

1. **Sayfada Ürün Listesi**

    - `ProductController::index()` metodu, `Product::getAll()` kullanarak tüm ürünleri alır ve `product_list.php` görünümünde listeler.
    - `product_list.php` dosyasında, `$products` değişkeni foreach döngüsü ile listelenir.

2. **Listelenen Ürünlerin Sepete Eklenmesi ve Sepetten Çıkarılması**

    - Ürünler sepete eklenebilir ve çıkarılabilir.
    - Sepete ekleme: `ProductController::addToCart()` metodu.
    - Sepetten çıkarma: `ProductController::removeFromCart()` ve `ProductController::deleteFromCart()` metotları.

3. **Birden Fazla Ürün Sepete Eklenebilir**

    - `addToCart()` metodu, aynı üründen birden fazla ekleme yapılabilir. Her ekleme, ürünün miktarını bir artırır.

4. **Ürünlerin Tamamı ya da Bir Tanesi Sepetten Çıkarılabilir**

    - `removeFromCart()` metodu, bir ürünü sepetten çıkarır veya miktarını azaltır.
    - `deleteFromCart()` metodu, bir ürünü tamamen sepetten çıkarır.

5. **Stok Kontrolü**

    - Sepete eklenen ürünler, stok miktarına göre sınırlandırılmıştır. Eğer sepetteki miktar, ürün stok miktarını aşarsa kullanıcıya uyarı verilir.

---

- **Bootstrap**: Projenin ön yüzünde responsive tasarım ve stil sağlamak için kullanılmıştır.
- **SweetAlert2**: Kullanıcılara daha iyi geri bildirim sağlamak için bildirim ve uyarılar için kullanılmıştır.
