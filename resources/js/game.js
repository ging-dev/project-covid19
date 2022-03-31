import Phaser from "phaser";

/** @type { Phaser.Types.Physics.Arcade.SpriteWithDynamicBody } */
var player;

/** @type { Phaser.Types.Input.Keyboard.CursorKeys } */
var cursors;

var isDead = false;

var isAttack = false;

var action = ['punch', 'kick'];

var life = 5;

class Game extends Phaser.Scene {
    constructor() {
        super();
    }

    preload() {
        this.load.spritesheet('player', 'images/player.png', {
            frameWidth: 48,
            frameHeight: 48,
        });
        this.load.image('logo', 'https://i.imgur.com/qg8RsRq.png');
    }

    create() {
        this.anims.create({
            key: 'walk',
            frames: this.anims.generateFrameNumbers('player', {start: 0, end: 3}),
            frameRate: 8,
            repeat: -1
        });

        this.anims.create({
            key: 'idle',
            frames: this.anims.generateFrameNumbers('player', {start: 5, end: 8}),
            frameRate: 8,
            repeat: -1
        });

        this.anims.create({
            key: 'jump',
            frames: this.anims.generateFrameNumbers('player', {start: 20, end: 23}),
            frameRate: 8,
        });

        this.anims.create({
            key: 'die',
            frames: this.anims.generateFrameNumbers('player', {start: 35, end: 37}),
            frameRate: 8,
        });

        this.anims.create({
            key: 'punch',
            frames: this.anims.generateFrameNumbers('player', {start: 15, end: 17}),
            frameRate: 8,
        });

        this.anims.create({
            key: 'kick',
            frames: this.anims.generateFrameNumbers('player', {start: 10, end: 13}),
            frameRate: 8,
        });

        player = this.physics.add.sprite(400, 100, 'player');
        player.setScale(1);
        player.setBounce(0);
        player.setCollideWorldBounds(true);
        player.body.setGravityY(0);

        let obj = this.physics.add.sprite(0, 0, 'logo');
        obj.setScale(0.15);
        obj.setCollideWorldBounds(true);
        obj.setBounce(1);
        obj.setGravity(0);
        obj.setVelocity(Phaser.Math.Between(-200, 200), 20);

        this.physics.add.collider(obj, player, endgame, null, this);

        cursors = this.input.keyboard.createCursorKeys();
    }

    update() {
        if ((isAttack && player.anims.isPlaying) || isDead) {
            // nothing to update
            return;
        } else {
            isAttack = false;
        }

        if (cursors.left.isDown) {
            player.setVelocityX(-200).setFlipX(false);
        } else if (cursors.right.isDown) {
            player.setVelocityX(200).setFlipX(true);
        } else {
            player.setVelocityX(0);
        }

        if (player.body.onFloor()) {
            if (player.body.velocity.x != 0) {
                player.play('walk', true);
            } else {
                player.play('idle', true);
            }

            if (cursors.up.isDown) {
                player.setVelocityY(-350);
                player.play('jump', true);
            }
        }
    }
};

/**
 * @this { Phaser.Scene }
 * @param { Phaser.Physics.Arcade.Sprite } obj
 * @param { Phaser.Types.Physics.Arcade.SpriteWithDynamicBody } player
 */
function endgame(obj, player)
{
    if (isDead) {
        return;
    }

    if (--life == 0) {
        isDead = true;
        player.setVelocityX(0);
        player.play('die', true);
    } else {
        isAttack = true;
        player.play(action[Phaser.Math.Between(0, 1)], true);
        obj.setVelocity(player.flipX ? 500 : -500, Phaser.Math.Between(-300, -600));
    }
}

let config = {
    type: Phaser.AUTO,
    transparent: true,
    scale: {
        mode: Phaser.Scale.FIT,
        parent: 'game',
        autoCenter: Phaser.Scale.CENTER_BOTH,
        width: 800,
        height: 250,
    },
    physics: {
        default: 'arcade',
        arcade: {
            gravity: { y: 300 },
            debug: false,
        }
    },
    pixelArt: true,
    scene: [ Game ],
};

var game = new Phaser.Game(config)
