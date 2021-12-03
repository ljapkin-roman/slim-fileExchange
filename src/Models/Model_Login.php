<?php

namespace Summit\Models;

use Summit\Core\Model;
use Firebase\JWT\JWT;
use Summit\classes\User;
use Summit\Validators\Validation_User as Valid_User;

class Model_Login extends Model
{
    public array $dataUser = ['errors' => [], 'session' => []];
    private object $user;
    public function isUserValid($email, $password, $host)
    {

        if($this->isEmailExist($email))
        {
            $hashPassword = $this->user->password;
            if (password_verify($password, $hashPassword))
            {
                $this->dataUser['session'] = $this->getDataToSession($this->user);
                $this->dataUser['session']['token'] = $this->createJWT($email, $host);
                return $this->dataUser;
            }
            else {
                $this->dataUser['errors']['password'] = 'The password is not valid';
                return $this->dataUser;
            }
        }

    }
    public function isEmailExist($email) :bool
    {
         if( $this->database::table('users')->where('email', $email)->first()) {
             $this->user = $this->database::table('users')->where('email', $email)->first();
             return true;
         }
         else {
             $this->dataUser['errors']['email'] = 'This email is not exist';
             return false;
         }
    }

    private function getDataToSession(object $user) {
        $session = [];
        $session['id'] = $user->id;
        $session['name'] = $user->name;
        $session['last_name'] = $user->last_name;
        $session['email'] = $user->email;
        $session['id'] = $user->id;
        return $session;
    }

    public function createJWT($email, $host) :string
    {
        $secretKey = 'bGS6lzFqvvSQ8ALbOxatm7/Vk7mLQyzqaS34Q4oR1ew=';
        $tokenId = base64_encode(random_bytes(16));
        $issuedAt = new \DateTimeImmutable();
        $expire = $issuedAt->modify('+6 minutes')->getTimestamp();      // Add 60 seconds
        $serverName = $host;
        $username = $email;                                           // Retrieved from filtered POST data

        // Create the token as an array
        $data = [
            'iat' => $issuedAt->getTimestamp(),    // Issued at: time when the token was generated
            'jti' => $tokenId,                     // Json Token Id: an unique identifier for the token
            'iss' => $serverName,                  // Issuer
            'nbf' => $issuedAt->getTimestamp(),    // Not before
            'exp' => $expire,                      // Expire
            'data' => [                             // Data related to the signer user
                'userName' => $username,            // User name
            ]
        ];

        // Encode the array to a JWT string.
        return JWT::encode(
            $data,      //Data to be encoded in the JWT
            $secretKey, // The signing key
            'HS512'     // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
        );
    }
}
