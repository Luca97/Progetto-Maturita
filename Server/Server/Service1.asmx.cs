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
                string connStr = "server=localhost;user=root;database=diesis;port=3306;password=;"; //stringa che definisce i parametri di connessione al DB
                MySqlDataReader rdr = null; //definisce il lettore di tipo MySqlReader 

                try //prova a lavorare sul DB
                {
                    MySqlConnection conn = new MySqlConnection(connStr);//crea una connessione con i parametri della stringa
                    conn.Open();//apre la connessione

                    string sql = "SELECT * FROM `users` WHERE username='" + usn + "'";//definisce l'interrogazione da eseguire sul database
                    MySqlCommand cmd = new MySqlCommand(sql, conn);//crea un comando MySql con connessione e query

                    rdr = cmd.ExecuteReader();//Invia CommandText a Connection e compila SqlDataReader
                    while (rdr.Read())//fin quando il lettore riesce a leggere qualcosa
                    {
                        if (rdr.GetString(0).Equals(usn) && rdr.GetString(1).Equals(MD5GenerateHash(psw)))//se usn e psw(criptata) ricevuti sono uguali a quella dell'istanza 
                        {
                            return "ok" ;// allora ritorna e-mail utente
                        }

                    }
                    conn.Close();//chiude la connessione
                }
                catch (Exception ex)//legge l'eccezione
                {
                    return ex.ToString();//ritorna l'eccezione
                }

            }

            else //se la chiave non risponde
            {
                return "nokey";
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

                string connStr = "server=localhost;user=root;database=diesis;port=3306;password=;";//stringa che definisce i parametri di connessione al DB

                MySqlDataReader rdr = null;//definisce il lettore di tipo MySqlReader 
                try
                {
                    MySqlConnection conn = new MySqlConnection(connStr);//crea una connessione con i parametri della stringa
                    conn.Open();//apre la connessione

                    string sql = "SELECT * FROM `users` WHERE email='" + eml + "'";//definisce l'interrogazione da eseguire sul database
                    MySqlCommand cmd = new MySqlCommand(sql, conn);//crea un comando MySql con connessione e query

                    rdr = cmd.ExecuteReader();//Invia CommandText a Connection e compila SqlDataReader
                    while (rdr.Read())//fin quando riesce a leggere qualcosa
                    {
                        if (rdr.GetString(2).Equals(eml))//se email ricevuta è uguala a quella dell'istanza 
                        {
                            username = rdr.GetString(0);//setta la variabile username con l'username letta dall'istanza
                            password = rdr.GetString(1);//setta la variabile password con la password letta dall'istanza
                            String passwordDaInviare = username + password;//crea la nuova password unendo usn e psw dell'istanza 
                            String nuovapassword = MD5GenerateHash(username + password);// crea la nuova password unendo usn e psw dell'istanza e applicando la codifica MD5 alla stringa ottenuta


                            rdr.Close();//chiude il lettore
                            sql = "    UPDATE Users SET Password = '" + nuovapassword + "' WHERE Username='" + username + "' AND Email='" + eml + "'   ";
                            cmd = new MySqlCommand(sql, conn);
                            cmd.ExecuteNonQuery();

                            SendEmail(eml, "Reset della password", "Ciao " + username + ", Ci è stata inviata una richiesta per recuperare la tua password; la nuova password è:" + passwordDaInviare);

                            return "ok";
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
                return "nokey";
            }

            return "nulla";

        }


        [WebMethod]
        public string Registrazione(string key, string eml, string usn, string psw, string nome, string cognome)
        {

            if (key.Equals("Unaacaso1997-"))
            {
                string connStr = "server=localhost;user=root;database=diesis;port=3306;password=;";
                bool valido = true;

                MySqlDataReader rdr = null;
                try
                {
                    MySqlConnection conn = new MySqlConnection(connStr);
                    conn.Open();

                    string sql = "SELECT * FROM `users` WHERE username='" + usn + "'";
                    MySqlCommand cmd = new MySqlCommand(sql, conn);
                    rdr = cmd.ExecuteReader();



                    while (rdr.Read())
                    {
                        if (rdr.GetString(0).Equals(usn))
                        {
                            valido = false;
                            return "nousn";
                        }

                        if (rdr.GetString(2).Equals(eml))
                        {
                            valido = false;
                            return "noeml";
                        }

                    }

                    rdr.Close();//aggiunto
                    if (valido == true)
                    {
                        try
                        {
                            string nuovaPassword = MD5GenerateHash(psw);
                            sql = "  INSERT INTO users (Username, Password, Email, Nome, Cognome) VALUES ('" + usn + "', '" + nuovaPassword + "', '" + eml + "', '" +nome+ "', '" +cognome+ "')  ";
                            cmd = new MySqlCommand(sql, conn);
                            cmd.ExecuteNonQuery();
                        }
                        catch (MySqlException ex)
                        {
                            return ex.ToString();
                        }


                        SendEmail(eml, "iscrizione a diesis#", "Grazie per esserti iscritto;\n Il tuo username è: " + usn + "\n La tua password è: " + psw + " (criptata)\n ");

                    }


                    conn.Close();
                }
                catch (Exception ex)
                {
                    return ex.ToString();
                }
                return "ok";
            }
            else
            {
                return "nokey";
            }

        }


        [WebMethod]
        public List<string> MieiTag(string key, string usn)
        {

            List<string> tag = new List<string>();
            if (key.Equals("Unaacaso1997-"))
            {
                tag.Clear();
                string connStr = "server=localhost;user=root;database=diesis;port=3306;password=;";

                MySqlDataReader rdr = null;
                try
                {
                    MySqlConnection conn = new MySqlConnection(connStr);
                    conn.Open();

                    string sql = "SELECT * FROM `files` WHERE username='" + usn + "'";
                    MySqlCommand cmd = new MySqlCommand(sql, conn);


                    rdr = cmd.ExecuteReader();
                    while (rdr.Read())
                    {
                        if (rdr.GetString(1).Equals(usn))
                        {
                            tag.Add(rdr.GetString(2) + "-" + rdr.GetDateTime(3) + "-" + rdr.GetString(4) + "-" + rdr.GetString(5) + "-" + rdr.GetString(6));
                        }

                    }



                    conn.Close();
                }
                catch (Exception ex)
                {
                    tag.Clear();
                    tag.Add(ex.ToString());
                    return tag;
                }

                return tag;

            }
            else
            {
                tag.Clear();
                tag.Add("nokey");
                return tag;
            }

        }


        [WebMethod]
        public string aggiungiTag(string key, string usn, string genere, string titolo, string indirizzo, int pubblico)
        {
            if (key.Equals("Unaacaso1997-"))
            {
                string connStr = "server=localhost;user=root;database=diesis;port=3306;password=;";

                try
                {
                    


                    MySqlConnection conn = new MySqlConnection(connStr);
                    conn.Open();



                    //string sql = "INSERT INTO `files` (  Username, Genere, DataCreazione, Titolo, Link) VALUES ('" + usn + "','" + genere + "', '"+ DateTime.Now.ToString("yyyy-MM-dd hh:mm:ss") + "','" + titolo + "','" + indirizzo + "','" + pubblico + "')";
                    string sql = "INSERT INTO `files` (`Id`, `Username`, `Genere`, `DataCreazione`, `Titolo`, `Link`, `Pubblico`)"+
                                              "VALUES (NULL, '" + usn + "', '" + genere + "', '" + DateTime.Now.ToString("yyyyMMddHHmmss") + "', '" + titolo + "', '" + indirizzo + "', '" + pubblico.ToString() + "')";
                    MySqlCommand cmd = new MySqlCommand(sql, conn);
                    cmd.ExecuteNonQuery();

                    SendEmail( GetEmail(usn), "Aggiunto un nuovo tag", "Ciao " + usn + ", Grazie per aver aggiunto un nuovo tag;\n        data registrazione: " + DateTime.Now.ToString("yyyy-MM-dd HH:mm:ss") + "\n        titolo: " + titolo + "\n      genere: " + genere + "\n ");

                    conn.Close();

                }
                catch (Exception ex)
                {
                    return ex.ToString();
                }
                return "ok";

            }
            else
            {
                return "nokey";
            }

        }


        [WebMethod]
        public string SendEmail(string eml, string obj, string text)
        {
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
            message.Subject = " " + obj + " ";
            //Set IsBodyHtml to true means you can send HTML email.
            message.IsBodyHtml = true;
            message.Body = "<h1>" + text + " </h1>";
            message.To.Add(eml);
            message.Priority = MailPriority.High;
            try
            {
                smtpClient.Send(message);
            }
            catch (Exception ex)
            {
                return ex.ToString();
            }

            return "ok";

        }


        [WebMethod]
        public string CambioPsw(string key, string usn, string vecchiaPsw, string nuovaPsw)//metodo per recuperare la psw, si fa passare la chiave di sicurezza e email
        {
            if (key.Equals("Unaacaso1997-"))//se la chiave di sicurezza corrisponde esegui
            {

                string connStr = "server=localhost;user=root;database=diesis;port=3306;password=;";//stringa che definisce i parametri di connessione

                MySqlDataReader rdr = null;//definisce il lettore di tipo MySsql 
                try
                {
                    MySqlConnection conn = new MySqlConnection(connStr);
                    conn.Open();

                    string sql = "SELECT * FROM `users` WHERE email='" + GetEmail(usn) + "' AND username='" + usn + "'  ";
                    MySqlCommand cmd = new MySqlCommand(sql, conn);

                    rdr = cmd.ExecuteReader();//Invia CommandText a Connection e compila SqlDataReader
                    while (rdr.Read())//fin quando riesce a leggere qualcosa
                    {
                        if (rdr.GetString(1).Equals(MD5GenerateHash(vecchiaPsw)))//se email ricevuta è uguala a quella dell'istanza 
                        {

                            String nuovapassword = MD5GenerateHash(nuovaPsw);// crea una password unendo usn e psw dell'istanza e applicando la codifica MD5 alla stringa ottenuta

                            rdr.Close();
                            sql = "    UPDATE Users SET Password = '" + nuovapassword + "' WHERE Username='" + usn + "' AND Email='" + GetEmail(usn) + "'   ";
                            cmd = new MySqlCommand(sql, conn);
                            cmd.ExecuteNonQuery();

                            SendEmail(GetEmail(usn), "cambio della password", "Ciao " + usn + ", ci è stata inviata una richiesta per cambiare la tua password;\n   la vecchia password:" + vecchiaPsw + "\n è stata sostituita con:" + nuovaPsw + "  ");

                            return "ok";
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
                return "nokey";
            }

            return "nulla";


        }

        
        public string MD5GenerateHash(string inputString)//metodo che restituisce una stringa crittografata con il metodo MD%
        {
            
            using (System.Security.Cryptography.MD5 md5 = System.Security.Cryptography.MD5.Create())
            {
                byte[] inputBytes = System.Text.Encoding.ASCII.GetBytes(inputString);
                byte[] hashBytes = md5.ComputeHash(inputBytes);

                // Convert the byte array to hexadecimal string
                StringBuilder sb = new StringBuilder();
                for (int i = 0; i < hashBytes.Length; i++)
                {
                    sb.Append(hashBytes[i].ToString("X").ToLower());
                }
                return sb.ToString();

            }



        }


        [WebMethod]
        public string CambioEml(string key, string usn, string vecchiaEml, string nuovaEml)//metodo per recuperare la psw, si fa passare la chiave di sicurezza e email
        {
            if (key.Equals("Unaacaso1997-"))//se la chiave di sicurezza corrisponde esegui
            {

                string connStr = "server=localhost;user=root;database=diesis;port=3306;password=;";//stringa che definisce i parametri di connessione

                MySqlDataReader rdr = null;//definisce il lettore di tipo MySsql 
                try
                {
                    MySqlConnection conn = new MySqlConnection(connStr);
                    conn.Open();

                    string sql = "SELECT * FROM `users` WHERE email='" + vecchiaEml + "' AND username='" + usn + "'  ";
                    MySqlCommand cmd = new MySqlCommand(sql, conn);

                    rdr = cmd.ExecuteReader();//Invia CommandText a Connection e compila SqlDataReader
                    while (rdr.Read())//fin quando riesce a leggere qualcosa
                    {
                        if (rdr.GetString(2).Equals(vecchiaEml))//se email ricevuta è uguala a quella dell'istanza 
                        {

                            rdr.Close();
                            sql = "    UPDATE Users SET Email = '" + nuovaEml + "' WHERE Username='" + usn + "' ";
                            cmd = new MySqlCommand(sql, conn);
                            cmd.ExecuteNonQuery();

                            SendEmail(nuovaEml, "cambio della email", "Ciao " + usn + ", ci è stata inviata una richiesta per cambiare la tua e-mail;\n   la vecchia email:" + vecchiaEml + "\n è stata sostituita con:" + nuovaEml + "  ");

                            return "ok";
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
                return "nokey";
            }

            return "nulla";


        }


        [WebMethod]
        public string InviaFile(string key, string address)
        {

            
            if(key.Equals("Unaacaso1997-"))
            {

                return "ok";
            }
            else
            {
                return "nokey";
            }

        }


        public string GetEmail(string usn)
        {

            //ricerca credenziali nel database sql
            string connStr = "server=localhost;user=root;database=diesis;port=3306;password=;"; //stringa che definisce i parametri di connessione al DB
            MySqlDataReader rdr = null; //definisce il lettore di tipo MySqlReader 

            try //prova a lavorare sul DB
            {
                MySqlConnection conn = new MySqlConnection(connStr);//crea una connessione con i parametri della stringa
                conn.Open();//apre la connessione

                string sql = "SELECT * FROM `users` WHERE username='" + usn + "'";//definisce l'interrogazione da eseguire sul database
                MySqlCommand cmd = new MySqlCommand(sql, conn);//crea un comando MySql con connessione e query

                rdr = cmd.ExecuteReader();//Invia CommandText a Connection e compila SqlDataReader
                while (rdr.Read())//fin quando il lettore riesce a leggere qualcosa
                {
                    if (rdr.GetString(0).Equals(usn))//se usn e psw(criptata) ricevuti sono uguali a quella dell'istanza 
                    {
                        return rdr.GetString(2);// allora ritorna e-mail utente
                    }

                }
                conn.Close();//chiude la connessione
            }
            catch (Exception ex)//legge l'eccezione
            {
                return ex.ToString();//ritorna l'eccezione
            }
            return "nulla";
        }
       
    }
}