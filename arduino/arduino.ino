int incomingByte = 0; // almacena el dato serie
int pin0=0; //Fotoresistencia
int pin1=1;//Humedad
int pin2=2;//Redswitch Ventana
int pin3=3;//Redswitch Cortina
int valorL=0; //Luz
int valorH=0; //Humedad
int valorEV=0; //Estado Ventana
int valorEC=0; //Estado Cortina
//Motores
//Motor Ventana
int enable1 = 4;
int dirm1_1 = 5;
int dirm1_2 = 6;
//Motor Cortina
int enable2 = 7;
int dirm2_1 = 8;
int dirm2_2 = 9;

//modo 0-Manual 1-automatico 
int modo = 1;
int server_cortina, server_ventana;

//Estados anteriores
int old_ventana, old_cortina;


void control(int valorH, int valorL,int valorEV,int valorEC){
  if((valorH > 100) && (!valorEV)) ventana(1);//cerrar
  if((valorH < 100) && (valorEV)) ventana(0);//abrir

  if((valorL < 300) && (valorEC)) cortina(0);//abrir
  if((valorL > 300) && (!valorEC)) cortina(1);//cerrar
}

void ventana(int accion){
  if (accion == 1)
{
 // Establece direccion
 digitalWrite(dirm1_1, HIGH);
 digitalWrite(dirm1_2, LOW);
 // Habilita el puente H
 digitalWrite(enable1, HIGH);
 delay(330);
 // Deshabilita el puente H
 digitalWrite(enable1, LOW);
 digitalWrite(dirm1_1, LOW);
 digitalWrite(dirm1_2, LOW);
}else{
 if (accion == 0){
 // Establece direccion
 digitalWrite(dirm1_1, LOW);
 digitalWrite(dirm1_2, HIGH);
 // Habilita el puente H
 digitalWrite(enable1, HIGH);
 delay(330);
 // Deshabilita el puente H
 digitalWrite(enable1, LOW);
 digitalWrite(dirm1_1, LOW);
 digitalWrite(dirm1_2, LOW);
 }
}

}

void cortina(int accion){
  if (accion == 1)
{
 // Establece direccion
 digitalWrite(dirm2_1, HIGH);
 digitalWrite(dirm2_2, LOW);
 // Habilita el puente H
 digitalWrite(enable2, HIGH);
 delay(500);
 // Deshabilita el puente H
 digitalWrite(enable2, LOW);
 digitalWrite(dirm2_1, LOW);
 digitalWrite(dirm2_2, LOW);
}else{
 if (accion == 0){
 // Establece direccion
 digitalWrite(dirm2_1, LOW);
 digitalWrite(dirm2_2, HIGH);
 // Habilita el puente H
 digitalWrite(enable2, HIGH);
 delay(500);
 // Deshabilita el puente H
 digitalWrite(enable2, LOW);
 digitalWrite(dirm2_1, LOW);
 digitalWrite(dirm2_2, LOW);
 }
}
}
void setup() {
Serial.begin(9600); // abre el puerto serie, y le asigna la velocidad de 9600 bps
  pinMode(4, OUTPUT); //Enable Motor Ventana
  pinMode(7, OUTPUT); //Enable Motor Cortina
// Prepara pin direction for motor Ventana
  pinMode(5, OUTPUT); 
  pinMode(6, OUTPUT);
// Prepara pin direction for motor Cortina
  pinMode(8, OUTPUT); 
  pinMode(9, OUTPUT);

//Entrdas Estados
pinMode(2, INPUT);
pinMode(3, INPUT);

}

void loop() {
  valorEV=digitalRead(pin2);
  valorEC=digitalRead(pin3);
  old_ventana=valorEV;
  old_cortina=valorEC;
  if(modo){ 
  valorL=analogRead(pin0);
  valorH=analogRead(pin1);
  //Serial.print("Valor de la fotoresistencia es\n"); Serial.println(valorL,'\n');
 //Serial.print("Valor del sensor de lluvia es\n"); Serial.println(valorH,'\n');
 //Serial.print("Valor del Estado es\n"); Serial.println(valorEV,'\n');
 
  control(valorH,valorL,valorEV,valorEC);}
  else{
    if(server_ventana && !valorEV){
      ventana(1);//Cerrar      
      }
      if(!server_ventana && valorEV){
      ventana(0);//Abrir
      }
      if(server_cortina && !valorEC){
      cortina(1);//Cerrar      
      }
      if(!server_cortina && valorEC){
      cortina(0);//Abrir
      }
    }
  valorEV=digitalRead(pin2);
  valorEC=digitalRead(pin3);
  if(valorEV != old_ventana || valorEC != old_cortina){
    //Serial.println("Hubo un Cambio");
    valorL=analogRead(pin0);
    valorH=analogRead(pin1);
    //yii_ventana=valorEV
    String yii_e_ventana = String(valorEV);
    String yii_e_cortina = String(valorEC);
    String yii_lluvia= String(valorH);
    String yii_luz = String(valorL);

    String yii_full = "EV:"+yii_e_ventana +"EC:"+ yii_e_cortina +"LL:"+yii_lluvia +"L:"+yii_luz;
    Serial.println(yii_full);
    }
}

void serialEvent(){
  String cadena,sub_cadena;
  int flag=0,automatico;
  cadena=Serial.readString();
 
  
  int startR, endR;
  startR = cadena.indexOf("C:");
  endR = cadena.indexOf(';');

  Serial.println(cadena.substring(startR,endR));
  if(startR == -1 || cadena.indexOf('V')==-1){
    flag=1;
    }  
  sub_cadena=cadena.substring(startR,endR);
  //Retornar a modo automatico
  automatico = cadena.indexOf("@ut0+-s");
  if(automatico != -1){
    modo = 1;
    }
  if(!flag){
    modo=0;
    startR = sub_cadena.indexOf("C:")+2;
    endR = sub_cadena.indexOf('V');
    //Serial.println(sub_cadena.substring(startR,endR));
    server_cortina=sub_cadena.substring(startR,endR).toInt();
    Serial.println(server_cortina);
    startR = sub_cadena.indexOf("V:")+2;
    endR = sub_cadena.indexOf(';');
    //Serial.println(sub_cadena.substring(startR,endR));
    server_ventana=sub_cadena.substring(startR,endR).toInt();
    Serial.println(server_ventana);
  }
}

