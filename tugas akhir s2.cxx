#include<stdio.h>
void pilih()
{
printf("============================================================\n\n");
printf("title \n\n");	printf("============================================================\n\n");
printf("Daftar benua : \n");
printf("1. Asia \n");
printf("2. Afrika \n");
printf("3. Amerika utara\n");
printf("4. Eropa \n");
printf("5. Australia \n");
printf("6. Amerika Selatan \n\n");
printf("============================================================\n\n");
	int x;
	int geo;
	printf("Pilih benua (1-7) = ");
	scanf("%i",&geo);

	switch(geo)
	{
		case 1:{
	printf("Benua Asia \n");	printf("============================================================\n\n");
printf("1. daftar negara \n");
printf("2. ras \n");
printf("3. peninggalan sejarah \n");
printf("4. suku \n");
printf("5. fakta menarik \n");
printf("============================================================\n\n");
	printf("pilih yang anda ingin lihat (1-5) = ");
	scanf("%i",&x);
	if (x==1)
	{
	printf("\n Daftar negara : \n");
	printf("1. Brunei Darussalam\n");
	printf("2. Indonesia\n");
	printf("3. Kamboja\n");
	printf("4. Malaysia\n");
	printf("5. Laos\n");
	printf("6. Malaysia\n");
    printf("7. Myanmar\n");
    printf("8. Filipina\n");
    printf("9. Singapura\n");
    printf("10. Thailand\n");
}
else if (x==2)
    {
    printf("\n Ras : \n");  
	printf("1. Ras Mongoloid\n"); 
	printf("2. Ras Kaukasoid\n"); 
	printf("3. Ras Negroid\n"); 		
}
    else if (x==3)
    {
    printf("\n Peninggalan sejarah : \n");  
	printf("1. Tembok Besar,Cina\n"); 
	printf("2. Taj Mahal, India\n"); 
	printf("3. Kota Terlarang Beijing\n"); 	
    printf("4. Kuil Angkor, Kamboja\n"); 	
    printf("5. Dambulla Cave Temple, Sri Lanka\n"); 
    printf("6. Kiyomizu-dera, Jepang\n"); 	
    printf("7. Borobudur, Indonesia\n"); 		
    printf("8. Kota Luang Prabang, Laos\n"); 	
    printf("9. Gereja Barok, Filipina\n"); 		
	printf("10. Ayyuthaya, Thailand\n"); 		
}
else if (x==4)
    {
    printf("\n Suku : \n");  
	printf("1. Suku Ainu\n"); 
	printf("2. Suku Thai\n"); 
    printf("3. Suku Moro\n"); 	
    printf("4. Suku Dravida\n"); 	
    printf("5. Suku Melayu\n"); 	
	
}
else if (x==5)
    {
    printf("\n Fakta menarik : \n");  
	printf("1. Menjadi Konsumen Beras Terbesar di Dunia.\n"); 
	printf("2. Memiliki Pertumbuhan Ekonomi Tercepat di Dunia.\n"); 
	printf("3. Memiliki 14 Gunung Tertinggi di Dunia.\n"); 	
	printf("4. Memiliki Banyak Bangunan Tinggi.\n"); 	
	printf("5. Menjadi Tempat Kelahiran Semua Agama Terbesar di Dunia.\n"); 	
}
break;}
		case 2:{
			printf("Benua Afrika \n");
	printf("============================================================\n\n");
printf("1. Daftar negara \n");
printf("2. Ras \n");
printf("3. Peninggalan sejarah \n");
printf("4. Suku \n");
printf("5. Fakta menarik \n");
printf("============================================================\n\n");
	printf("pilih yang anda ingin lihat (1-5) = ");
	scanf("%d",&x);
	if (x==1)
	{
	printf("\n Daftar negara : \n");
	printf("1. Maroko\n");
	printf("2. Mesir\n");
	printf("3. Afrika selatan\n");
	printf("4. Ethiopia\n");
	printf("5. Tanzania\n");
	printf("6. Rwanda\n");
    printf("7. Ghana\n");
    printf("8. Kenya\n");
    printf("9. Namibia\n");
    printf("10. Malawi\n");
	}
	else if (x==2)
    {
    printf("\n Ras : \n");  
	printf("1. Ras Kaukasoid keturunan Arab\n"); 
	printf("2. Ras Kaukasoid keturunan Eropa\n"); 
	printf("3. Ras Negroid\n"); 		
}
    else if (x==3)
    {
    printf("\n Peninggalan sejarah : \n");  
	printf("1. Fort jesus, kenya\n"); 
	printf("2. Piramida Giza, Mesir\n"); 
	printf("3. Masjid Larabanga, Ghana\n"); 	
    printf("4. Pulau Robben, Afrika selatan\n"); 	
    printf("5. Kasbah of Telouet, Maroko\n"); 
    printf("6. Memorial Genosida Kigali, Rwanda\n");
    printf("7. Gereja Lalibela, Ethiopian\n"); 		
    printf("8. Kilwa Kisiwani, Tanzania\n"); 	
    printf("9. Christuskirche, Namibia\n"); 		
	printf("10. Chongoni rock art area, Malawi	\n"); 
}
else if (x==4)
    {
    printf("\nSuku : \n");  
	printf("1. Suku Pighmy\n"); 
	printf("2. Suku Bushman\n"); 
	printf("3. Suku Zhun\n"); 	
	printf("4. Suku Negroid\n"); 	
	printf("5. Suku Maasai\n"); 	
	printf("6. Suku Tuareg\n"); 	
	printf("7. Suku Mursi\n"); 	
	printf("8. Suku Hmer\n"); 	
	printf("9. Suku Kuba\n"); 	
	printf("10. Suku Zulu\n"); 						
	
}
else if (x==5)
    {
    printf("\n Fakta menarik : \n");  
	printf("1. Benua Afrika adalah benua terbesar kedua di bumi.\n"); 
	printf("2. Benua Afrika terletak di empat belahan bumi .\n"); 
	printf("3. Benua terpanas di bumi dan benua terkering ketiga di bumi .\n"); 	
	printf("4. Tidak hanya terdapat penduduk berkulit hitam yang tinggal di Benua dan negara-negara Afrika.Negara Afrika Selatan adalah negara yang memiliki populasi penduduk kulit putih terbanyak.\n");
	printf("5. Hampir setengah wilayah Afrika merupakan sabana.\n"); 	
   printf("6. Kelangkaan air minum bukan menjadi sesuatu yang terjadi terus menerus di Afrika.\n");
   printf("7. Buta huruf 40% di seluruj dunia\n");
   printf("8. Afrika memiliki banyak persediaan mineral.\n");
   printf("9. Dua puluh lima persen spesies burung di dunia terdapat di Afrika \n");
   printf("10. Suku San yang tinggal di bagian Selatan Afrika dipercaya jadi salah satu suku tertua di Bumi dan dipercaya jadi keturunan langsung dari Homo Sapiens pertama.\n");
}
break;}
case 3:{
			printf("Benua Amerika Utara \n");
	printf("============================================================\n\n");
printf("1. Daftar negara \n");
printf("2. Ras \n");
printf("3. Peninggalan sejarah \n");
printf("4. Suku \n");
printf("5. Fakta menarik \n");
printf("============================================================\n\n");
	printf("pilih yang anda ingin lihat (1-5) = ");
	scanf("%d",&x);
	if (x==1)
	{
	printf("\nbDaftar negara : \n");
	printf("1. Amerika serikat\n");
	printf("2. Canada\n");
	printf("3. Mexico\n");
	printf("4. Jamaika\n");
	printf("5. Guetemala\n");
	printf("6. Haiti\n");
    printf("7. Kuba\n");
    printf("8. Republik dominika\n");
    printf("9. Honduras\n");
	}
	else if (x==2)
    {
    printf("\n Ras : \n");  
	printf("1. Ras Kaukasoid \n"); 		
}
    else if (x==3)
    {
    printf("\n Peninggalan sejarah : \n");  
	printf("1. Whasington Monument, Washington DC, Amerika serikat\n"); 
	printf("2. Fortress of Louisbourg, Canada\n"); 
	printf("3. Zona arquelogica uxmal, Mexico\n"); 	
    printf("4. Bob marley museum, Jamaika\n"); 	
    printf("5. Thecitadelle, Haiti\n"); 
    printf("6. Archaeological park and ruins of quirigua, Guatemala\n");
    printf("7. Castillo de San Pedro de la Roca, Kuba\n"); 		
    printf("8. Alcàzar de colòn, Republik dominika\n");
    printf("9. Iglesia el rosario, El savador\n"); 		
	printf("10. Pyramid over rosalila temple, Honduras\n"); 
}
else if (x==4)
    {
    printf("\n Suku : \n");  
	printf("1. Suku Seminole\n"); 
	printf("2. Suku Lakota\n"); 
	printf("3. Suku Cherokee\n"); 	
	printf("4. Suku Apache\n"); 	
}
else if (x==5)
    {
    printf("\n Fakta menarik : \n");  
	printf("1. Tidak ada satu negara pun di Amerika Utara yang terkurung daratan.\n"); 
	printf("2. Luas benua Amerika Utara kira-kira sama dengan luas wilayah yang diduduki oleh Uni Soviet.\n"); 
	printf("3. Pulau-pulau yang termasuk di dalamnya kira-kira 20% dari total luasnya.\n"); 	
	printf("4. Di benua ini ada Grand Canyon, ngarai terbesar di Bumi.\n");
	printf("5. Lebih dari 960 spesies mamalia hidup di ruang terbukanya.\n"); 	
   printf("6. Tiga kali lebih banyak orang yang tinggal di Cina daripada di seluruh Amerika Utara.\n");
   printf("7. Dari segi luas, benua Amerika Utara menempati urutan ketiga di dunia.\n");
   printf("8. Benua ini mendapatkan namanya untuk menghormati navigator Amerigo Vespucci.\n");
   printf("9. Titik paling utara dari benua Amerika Utara adalah pulau Greenland, omong-omong, yang terbesar di dunia.\n");
   printf("10. Menurut berbagai perkiraan, usia Amerika Utara adalah dari 1 hingga 1,5 miliar tahun.\n");
}
break;}
case 4:{
			printf("Benua Eropa \n");
	printf("============================================================\n\n");
printf("1. Daftar negara \n");
printf("2. Ras \n");
printf("3. Peninggalan sejarah \n");
printf("4. Suku \n");
printf("5. Fakta menarik \n");
printf("============================================================\n\n");
	printf("pilih yang anda ingin lihat (1-5) = ");
	scanf("%d",&x);
	if (x==1)
	{
	printf("\n Daftar negara : \n");
	printf("1. Inggris\n");
	printf("2. Belanda\n");
	printf("3. Jerman\n");
	printf("4. Italia\n");
	printf("5. Swiss\n");
	printf("6. Belgia\n");
    printf("7. Russia\n");
    printf("8. Polandia\n");
    printf("9. Denmark\n");
    printf("10. Prancis\n");
	}
	else if (x==2)
    {
    printf("\n Ras : \n");  
	printf("1. Ras Kaukasoid\n"); 
}
    else if (x==3)
    {
    printf("\n Peninggalan sejarah : \n");  
	printf("1. Menara Eiffel, Prancis\n"); 
	printf("2. Colosseum, Italia\n"); 
	printf("3. Acropolis Athena, Yunani\n"); 	
    printf("4. Menara Pisa, Italia\n"); 	
    printf("5. Haghia Sofia, Turki\n"); 
    printf("6. Al Hambra, Spanyol\n");
    printf("7. Katedral St. Basil, Russia\n"); 		
    printf("8. Big Ben, Inggris\n");
    printf("9. Zaanse Schans, Belanda\n"); 		
	printf("10. Champs Elysees , Prancis\n"); 
}
else if (x==4)
    {
    printf("\n Suku : \n");  
	printf("1. Suku Nordik\n"); 
	printf("2. Suku Alpen \n"); 
	printf("3. Suku Mediteran \n"); 
	printf("4. Suku Slavia \n"); 
	printf("5. Suku Dinarik \n"); 	
}
else if (x==5)
    {
    printf("\n Fakta menarik : \n");  
	printf("1. Mata uang : dolar.\n"); 
	printf("2. Istanbul adalah kota yang menjadi bagian dari dua benua.\n"); 
	printf("3. Di benua Eropa terdapat negara terkecil di dunia, yaitu Vatikan yang luas wilayahnya hanya 0,44 kilometer persegi.\n"); 	
	printf("4. Patung Liberti yang berada di new York, di bangun di Prancis.\n");
	printf("5. Sebuah desa di Wales, Inggris memiliki nama resmi yang terdiri dari 58 huruf, yaitu Llanfairpwllgwyngyllgogerychwyrndrobwllllantysiliogogogoch.\n"); 	
   printf("6. Benua Eropa dijuluki sebagai Benua Biru. Julukan ini melekat karena mayoritas penduduk di Eropa memiliki mata berwarna biru yang cerah dan indah.\n");
   printf("7. Benua Eropa memiliki jumlah negara yang sangat banyak dibandingkan dengan benua lainnya di dunia. Terdapat 44 negara di Eropa, yang meliputi berbagai macam bahasa, budaya, dan tradisi.\n");
}
break;}
case 5:{
			printf("Benua Australia \n");
	printf("============================================================\n\n");
printf("1. Daftar negara \n");
printf("2. Ras \n");
printf("3. Peninggalan sejarah \n");
printf("4. Suku \n");
printf("5. Fakta menarik \n");
printf("============================================================\n\n");
	printf("pilih yang anda ingin lihat (1-5) = ");
	scanf("%d",&x);
	if (x==1)
	{
	printf("\n Daftar negara : \n");
	printf("1. New South Wales (NSW)\n");
	printf("2. Northern Territory (NT) \n");
	printf("3. Queensland (QLD) \n");
	printf("4. South Australia (SA)\n");
	printf("5. Tasmania (TAS) \n");
	printf("6. Victoria (VIC)\n");
    printf("7. Western Australia (WA) \n");
    printf("8. Australian Capital Territory (ACT)\n");
	}
	else if (x==2)
    {
    printf("\n Ras : \n");  
	printf("1. Ras Kaukasoid\n"); 
}
    else if (x==3)
    {
    printf("\n Peninggalan sejarah : \n");  
	printf("1. Sydney Opera House, New South Wales\n"); 
}
else if (x==4)
    {
    printf("\n Suku : \n");  
	printf("1. Suku Aborigin\n"); 	
}
else if (x==5)
    {
    printf("\n Fakta menarik : \n");  
	printf("1. Lebih dari 80% cagar alam negara ini adalah unik bagi Australia; dari Koala ke Kanguru, ikan hiu, ular dan laba-laba. Di Australia terdapat kurang lebih satu juta spesies asli yang berlainan.\n"); 
	
}
break;}
case 6:{
			printf("Benua Amerika Selatan\n");
	printf("============================================================\n\n");
printf("1. Daftar negara \n");
printf("2. Ras \n");
printf("3. Peninggalan sejarah \n");
printf("4. Suku \n");
printf("5. Fakta menarik \n");
printf("============================================================\n\n");
	printf("pilih yang anda ingin lihat (1-5) = ");
	scanf("%d",&x);
	if (x==1)
	{
	printf("\n Daftar negara : \n");
	printf("1. Argentina\n");
	printf("2. Bolivia\n");
	printf("3. Peru\n");
	printf("4. Brazil\n");
	printf("5. Chili\n");
	printf("6. Ekuador\n");
    printf("7. Paeaguay\n");
    printf("8. Uruguay\n");
    printf("9. Kolumbia\n");
    printf("10. Guyana\n");
	}
	else if (x==2)
    {
    printf("\n Ras : \n");  
	printf("1. Mestiz(orang-orang yang berdarah campuran Eropa dan non-Eropa. )\n"); 
	printf("2. Keturunan Indian dan Eropa dan mulatto(orang campuran kulit putih dan hitam) \n");	printf("3. Keturunan Eropa dengan Afrika.\n"); 
}
    else if (x==3)
    {
    printf("\n Peninggalan sejarah : \n");  
	printf("1. Cagar Hutan Tenggara Atlantik, Brazil\n"); 
	printf("2. Taman Nasional Canaima, Venezuela\n"); 
	printf("3. Chavìn, Peru\n"); 	
    printf("4. Kelompok Gereja Chiloé, Chili\n"); 	
    printf("5. Kota Cuzco, Peru\n"); 
    printf("6. Kota Potosí, Bolivia\n");
    printf("7. Kota Quito, Ekuador\n"); 		
    printf("8. Fuerte de Samaipata, Bolivia\n");
    printf("9. Pusat Sejarah Kota Santa Cruz de Mompox, Kolombia\n"); 		
	printf("10. Cueva de las Manos - Argentina\n"); 
	printf("11. Kompleks Konservasi Amazon Tengah, Brazil\n");
}
else if (x==4)
    {
    printf("\n Suku : \n");  
	printf("1. Suku Inca\n"); 	
}
else if (x==5)
    {
    printf("\n Fakta menarik : \n");  
	printf("1. Sebagian besar negara di Amerika Selatan dibebaskan dari kekuasaan kolonial Spanyol dan Portugal, namun ada dua daerah yang masih dikelola oleh Eropa dan Inggris , yaitu Guyana Prancis dan Kepulauan Falkland.\n"); 
	printf("2. Lima dari 50 kota terbesar di dunia berada di Amerika Selatan, yaitu Sao Paulo, Lima, Bogota, Rio de Janeiro, dan Santiago.\n"); 
	printf("3. Dua dari empat area hutan tropis murni yang tersisa di dunia berada di Amerika Selatan yaitu Hutan hujan Amazon dan Hutan Iwokrama di Guyana.\n"); 	
	printf("4. Hutan hujan Amazon diyakini memiliki keanekaragaman hayati terbesar di dunia.\n");
	printf("5. Chili merupakan rumah bagi gurun non-kutub paling kering di dunia, yaitu Gurun Atacama.\n"); 	
   printf("6. La Paz merupakan ibu kota administrasi tertinggi di dunia.\n");
   printf("7. Bendungan Itaipu di Paraguay merupakan fasilitas hidroelektrik terbesar kedua di dunia.\n");
   printf("8. Brasil tidak hanya diberi status sebagai negara terbesar di benua Amerika, tetapi juga memiliki Situs Warisan Dunia UNESCO terbanyak dengan total 21 situs.\n");
   printf("9. Simon Bolivar adalah tokoh militer dan diplomatik terbesar dalam sejarah, yang memimpin revolusi lima negara.\n");
}
break;}}
}
void main ()
{  
	int i;
for (i=1;i<=10;i++)

	pilih();

}
