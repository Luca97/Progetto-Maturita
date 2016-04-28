using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Services;
using System.Data.SqlClient;
using MySql.Data.MySqlClient;
using MySql.Data;
using System.Text;
using System.Net.Mail;
using System.Net;
using System.Security.Cryptography;

namespace Server
{
    /// <summary>
    /// Descrizione di riepilogo per Service1
    /// </summary>
    [WebService(Namespace = "http://tempuri.org/")]
    [WebServiceBinding(ConformsTo = WsiProfiles.BasicProfile1_1)]
    [System.ComponentModel.ToolboxItem(false)]
    // Per consentire la chiamata di questo servizio Web dallo script utilizzando ASP.NET AJAX, rimuovere il commento dalla riga seguente. 
    // [System.Web.Script.Services.ScriptService]
    public class Service1 : System.Web.Services.WebService
    {

        [WebMethod]
        public string Autenticazione(string key, string usn, string psw)//metodo per autenticarsi, si fa passare la chiave di sicurezza, username e password
        {

            if (key.Equals("Unaacaso1997-"))//se la chiave di sicurezza corrisponde esegui
            {
                //ricerca credenziali nel database sql

                string connStr = "server=localhost;user=root;database=diesis;port=3306;password=;"; //stringa che definisce i parametri di connessione
                MySqlDataReader rdr = null; //definisce il lettore di tipo MySsql 
                
                try //prova a lavorare sul DB
                {
                    MySqlConnection conn = new MySqlConnection(connStr);//crea una connessione con i parametri della stringa
                    conn.Open();//crea la connessione

                    string sql = "SELECT * FROM `users` WHERE username='" + usn + "'";//definisce l'interrogazione da eseguire sul database
                    MySqlCommand cmd = new MySqlCommand(sql, conn);//crea un comando MySql con connessione e query

                    rdr = cmd.ExecuteReader();//Invia CommandText a Connection e compila SqlDataReader
                    while (rdr.Read())//fin quando riesce a leggere qualcosa
                    {
                        if (rdr.GetString(0).Equals(usn) && rdr.GetString(1).Equals(psw))//se usn e psw ricevuti sono uguali a quella dell'istanza 
                        {
                            return "ok";// allora ritorna ok
                        }

                    }
                    conn.Close();//chiude la connessione
                }
                catch (Exception ex)//legge l'eccezione
                {
                     return ex.ToString();//ritorna l'eccezione
                }

            }
            
            else // se la chiave non risponde
            {
                return "tentativo di accesso fraudolento";
            }

            return "nulla";//se non trova nulla
            
        }


        [WebMethod]
        public string RecuperoPsw(string key, string eml)//metodo per recuperare la psw, si fa passare la chiave di sicurezza e email
        {

            if (key.Equals("Unaacaso1997-"))//se la chiave di sicurezza corrisponde esegui
            {
                //ricerca credenziali in sql

                String password = ""; //variabile per salvare la password dell'istanza
                String username = ""; //variabile per salvare l'username dell'istanza

                string connStr = "server=localhost;user=root;database=diesis;port=3306;password=;";//stringa che definisce i parametri di connessione

                MySqlDataReader rdr = null;//definisce il lettore di tipo MySsql 
                try
                {
                    MySqlConnection conn = new MySqlConnection(connStr);
                    conn.Open();

                    // string sql = "INSERT INTO `contatti` (`ID`, `Nome`, `email`, `Tel`) VALUES (NULL, 'xxx', 'xxx', 'xxx');";
                    string sql = "SELECT * FROM `users` WHERE email='" + eml + "'";
                    MySqlCommand cmd = new MySqlCommand(sql, conn);

                    rdr = cmd.ExecuteReader();//Invia CommandText a Connection e compila SqlDataReader
                    while (rdr.Read())//fin quando riesce a leggere qualcosa
                    {
                        if (rdr.GetString(2).Equals(eml))//se email ricevuta è uguala a quella dell'istanza 
                        {
                            username = rdr.GetString(0);//setta la variabile username con l'username letta dell'istanza
                            password = rdr.GetString(1);//setta la variabile password con la password letta dell'istanza
                            String nuovapassword = MD5GenerateHash(username+password);// crea una password unendo usn e psw dell'istanza e applicando la codifica MD5 alla stringa ottenuta
                            
                            cmd.Parameters.AddWithValue("@usn", username);
                            cmd.Parameters.AddWithValue("@psw", nuovapassword);
                            cmd.Parameters.AddWithValue("@eml", eml);
                            cmd.CommandText = "UPDATE Users(Username, Password, Email) VALUES (@usn, @psw, eml) WHERE Username='" + username + "' AND Email='" + eml + "'";

                            //modulo per mandare all'utente la nuova password
                            SmtpClient smtpClient = new SmtpClient();
                            NetworkCredential basicCredential = new NetworkCredential("noreply.diesis@gmail.com", "06021997Lucaf6-");
                            MailMessage message = new MailMessage();
                            MailAddress fromAddress = new MailAddress("noreply.diesis@gmail.com");

                            smtpClient.Host = "smtp.gmail.com";
                            smtpClient.UseDefaultCredentials = false;
                            smtpClient.Credentials = basicCredential;
                            smtpClient.Port = 587;
                            smtpClient.EnableSsl = true;

                            message.From = fromAddress;
                            message.Subject = "Cambio della password";
                            //Set IsBodyHtml to true means you can send HTML email.
                            message.IsBodyHtml = true;
                            message.Body = "Ci è stata inviata una richiesta per recuperare la tua password; la nuova password è:" + nuovapassword ;
                            message.To.Add(eml);
                            message.Priority = MailPriority.High;

                            try
                            {
                                smtpClient.Send(message);
                            }
                            catch (Exception ex)
                            {
                                //Error, could not send the message
                                return ex.ToString();
                            }
                            
                        }
                        break;
                    }
                    conn.Close();//chiude la connessione con il DB
                }
                catch (Exception ex)
                {
                    return ex.ToString();

                }
               
            }
            else
            {
                return "tentativo di accesso fraudolento";
            }

            return "nulla";
        
        }


        [WebMethod]
        public string Registrazione(string key, string eml, string usn, string psw)
        {

            if (key.Equals("Unaacaso1997-"))
            {
                //inserimento nuovo utente in sql 

                return "ok";
            }
            else
            {
                return "nokey";
            }

        }


        [WebMethod]
        public string MieiTag(string key, string usn)
        {

            if (key.Equals("Unaacaso1997-"))
            {
                //ricerca dei tag per usn

                return "ok";
            }
            else
            {
                return "nokey";
            }

        }


        public static string MD5GenerateHash(string inputString)
        {
            System.Security.Cryptography.MD5 hash = System.Security.Cryptography.MD5.Create();
            Byte[] inputBytes = ASCIIEncoding.Default.GetBytes(inputString);
            Byte[] outputBytes = hash.ComputeHash(inputBytes);
            return Convert.ToBase64String(outputBytes);
        }



    }
}